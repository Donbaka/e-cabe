/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package sms;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import twitter4j.Paging;
import twitter4j.Status;
import twitter4j.StatusUpdate;
import twitter4j.Twitter;
import twitter4j.TwitterException;
import twitter4j.TwitterFactory;
import jarowinkler.JaroWinkler;
import java.sql.PreparedStatement;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

public class Harga {

    /**
     * @param args the command line arguments
     */
    //inisialisasi data untuk menyambungkan ke database
//    private static String database = "jdbc:mysql://localhost/odz";
//    private static String username = "root";
//    private static String password = "";
    private static final String database = "jdbc:mysql://localhost/cabe";
    private static final String username = "root";
    private static final String password = "";
    //inisialisasi SQL serta command untuk ke database
    private static String SQL;
    private static Connection con;
    private static Statement stm;
    private static PreparedStatement pstmt;
    private static ResultSet rs;
    //inisialisasi class JaroWinkler
    JaroWinkler JW = new JaroWinkler();
    Query query = new Query();
    SmsSender send = new SmsSender();
    // Harga harga = new Harga();

    public String[] Regex(String sms) {
        // String to be scanned to find the pattern.
        // Format tweet kas masjid==> @opendatazis *nama_masjid*alamat*pemasukan*pengeluaran*saldo* #kasmasjid
        String pattern_harga = "^\\LAPOR[ ]*(.*)\\#(.\\d*.)\\#(.\\d*.)";

        // Create a Pattern object
        // System.out.println(pattern_harga.replace("\\LAPOR", ""));
        Pattern r_harga = Pattern.compile(pattern_harga.replace("\\LAPOR", "LAPOR"));
        int index = 4;
        // Now create matcher object.
        Matcher harga = r_harga.matcher(sms);

        if (harga.find()) {
            String[] a = {harga.group(0), harga.group(1), harga.group(2), harga.group(3)};
            return a;
        } else {
            String[] a = {"error"};
            // send.send(sms, sms);
            return a;
        }
    }

    public void connect() {
        try {
            Class.forName("com.mysql.jdbc.Driver");
            con = DriverManager.getConnection(database, username, password);
            stm = con.createStatement();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public String cekKabupaten(String kabupaten) throws SQLException {
        connect();
        ResultSet result = stm.executeQuery(query.kabupaten);
        double similarity = 0;
        String id_kab = "";
        while (result.next()) {
            double new_similarity = JW.compare(kabupaten, result.getString("NAMA"));
            if (new_similarity > similarity) {
                similarity = new_similarity;
                if (similarity > 0.8) {
                    id_kab = result.getString("ID_KABKOTA");
                } else {
                    id_kab = "false";
                }
            }
        }
        return id_kab;
    }

    public String cekKomoditas(String komoditas) throws SQLException {
        connect();
        ResultSet result = stm.executeQuery(query.komoditas);
        double similarity = 0;
        String id_komoditas = "";
        while (result.next()) {
            double new_similarity = JW.compare(komoditas, result.getString("komoditas"));
            if (new_similarity > similarity) {
                similarity = new_similarity;
                if (similarity > 0.8) {
                    id_komoditas = result.getString("id");
                } else {
                    id_komoditas = "false";
                }
            }
        }
        return id_komoditas;
    }

    public String cekPetani(String noHP) throws SQLException {
        connect();
        ResultSet result = stm.executeQuery(query.cekPetani + noHP);
        String idPetani = "";
        while (result.next()) {

            idPetani = result.getString("id");

        }
        return idPetani;
    }

    public String cekKecamatan(String id_kabupaten, String kecamatan) throws SQLException {
        connect();
        ResultSet result = stm.executeQuery(query.kecamatan + id_kabupaten);
        double similarity = 0;
        String id_kec = "";
        while (result.next()) {
            double new_similarity = JW.compare(kecamatan, result.getString("NAMA"));
            if (new_similarity > similarity) {
                similarity = new_similarity;
                if (similarity > 0.8) {
                    id_kec = result.getString("ID_KECAMATAN");
                } else {

                    id_kec = "false";
                }
            }
        }
        return id_kec;
    }

    public void updateSms(String no) throws SQLException {
        connect();
        stm.executeUpdate(query.updateSms + no);

        // pstmt.executeUpdate(query.updateSms);
    }

    public void insertHarga(String idKomoditas, String idPetani, String harga, String stok) throws SQLException {
        connect();
        stm.executeUpdate("INSERT INTO `harga_petani` (`id_komoditas`, `id_petani`, `harga`, `stok`) VALUES ('" + idKomoditas + "', '" + idPetani + "', '" + harga + "', '" + stok + "');");

        // pstmt.executeUpdate(query.updateSms);
    }

    public boolean cekDaftar(String no) throws SQLException {

        boolean terdaftar;
        connect();
        ResultSet result = stm.executeQuery(query.cekDaftar + no);
        terdaftar = result.next();
        con.close();
        return terdaftar;

    }

    public void cekSms() throws SQLException {
        //String suk = "";
        connect();
        ResultSet result = stm.executeQuery(query.cekSms);
        while (result.next()) {
            String text[];

            //try {
            text = Regex(result.getString("TextDecoded"));
            if (text[0].equalsIgnoreCase("error")) {
//                send.send(rs.getString("SenderNumber"), "Maaf format yang anda masukkan salah. Format SMS:\n"
//                        + "LAPOR jenis-komoditas#harga#nama-pasar#kecamatan#kabupaten/kota\n");
                send.send(result.getString("SenderNumber"), "Yang bener formatnya njeeng");
//                        + "LAPOR jenis-komoditas#harga#nama-pasar#kecamatan#kabupaten/kota\n");
            } else {
                if (cekDaftar(result.getString("SenderNumber"))) {
                    insertHarga(cekKomoditas(text[1]), cekPetani(result.getString("SenderNumber")), text[2], text[3]);
                    send.send(result.getString("SenderNumber"), "Terima Kasih telah berkontribusi dalam melakukan pelaporan harga komoditas");
                } else {
                    send.send(result.getString("SenderNumber"), "daftar sek cuk");

                }
            }

            updateSms(result.getString("ID"));
        }

    }
//  

    public static void main(String[] args) throws SQLException, ParseException {
        Harga harga = new Harga();
      //   System.out.println(harga.cekPetani("+6285748409235"));
       harga.cekSms();

    }

}
