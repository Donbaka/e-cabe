/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package twit;

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
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

public class Twit {

    /**
     * @param args the command line arguments
     */
    //inisialisasi data untuk menyambungkan ke database
//    private static String database = "jdbc:mysql://localhost/odz";
//    private static String username = "root";
//    private static String password = "";
    private static String database = "jdbc:mysql://localhost/open_data_zis";
    private static String username = "open_data_zis";
    private static String password = "open_data_zis";
    //inisialisasi SQL serta command untuk ke database
    private static String SQL;
    private static Connection con;
    private static Statement stm;
    private static ResultSet rs;
    //inisialisasi class JaroWinkler
    static JaroWinkler JW = new JaroWinkler();

    public  String[] Regex(String sms) {
        // String to be scanned to find the pattern.
        // Format tweet kas masjid==> @opendatazis *nama_masjid*alamat*pemasukan*pengeluaran*saldo* #kasmasjid
        String pattern_harga = "^\\LAPOR[ ]*(.*)\\#(.\\d*.)\\#(.*.)\\#(.*.)\\#(.*.)";

        // Create a Pattern object
       // System.out.println(pattern_harga.replace("\\LAPOR", ""));
        Pattern r_harga = Pattern.compile(pattern_harga.replace("\\LAPOR", "LAPOR"));
        int index = 6;
        // Now create matcher object.
        Matcher harga = r_harga.matcher(sms);

        if (harga.find()) {
            String[] a = {harga.group(0), harga.group(1), harga.group(2), harga.group(3), harga.group(4), harga.group(5)};
            return a;
        } else {
            String[] a = {"error"};
            return a;
        }
    }

//    public void connect() {
//        try {
//            Class.forName("com.mysql.jdbc.Driver");
//            con = DriverManager.getConnection(database, username, password);
//            stm = con.createStatement();
//        } catch (Exception e) {
//            e.printStackTrace();
//        }
//    }

    public Date format(String create_date) throws ParseException {
        DateFormat outputFormat = new SimpleDateFormat("dd-MM-yyyy HH:mm");
        DateFormat inputFormat = new SimpleDateFormat("EEE MMM dd HH:mm:ss ZZZZZ yyyy");
        inputFormat.setLenient(true);

        Date date = inputFormat.parse(create_date);
        return date;
    }

    public String[] cek_alamat(String masjid, String alamat) throws SQLException {
        String[] cek_alamat = {"", ""};
        String[] hasilJW = {"", ""};
        if (!JW.cek_masjid(masjid).equals("false")) {
            String new_masjid = JW.cek_masjid(masjid);
            hasilJW = JW.cek_alamat(new_masjid, alamat);
            if (hasilJW[0].equals("false")) {
                cek_alamat[0] = masjid;
                cek_alamat[1] = alamat;
            } else {
                cek_alamat[0] = hasilJW[0];
                cek_alamat[1] = hasilJW[1];
            }
        } else {
            cek_alamat[0] = hasilJW[0];
            cek_alamat[1] = hasilJW[1];
        }
        return cek_alamat;
    }
    public static void main(String[] args) throws SQLException, ParseException {
        Twit t = new Twit();
      //  t.cek_alamat("haha", "hehe");
        for(int i = 0; i<6;i++){
        System.out.println(t.Regex("LAPOR cabe keriting#12000#Pasar Keputih#Sukolilo#Surabaya")[i]);
        }
        //  t.
       // t.userMention();
//        int a = t.cek_minggu("Tue Jun 23 13:15:10 ICT 2015");
//        System.out.println(a);
//        t.getLastFriday();

    }

}
