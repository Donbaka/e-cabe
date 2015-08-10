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

    public static String[] Regex(String tweet, String info) {
        // String to be scanned to find the pattern.
        // Format tweet kas masjid==> @opendatazis *nama_masjid*alamat*pemasukan*pengeluaran*saldo* #kasmasjid
        String pattern_kas = "^\\@opendatazis[ ]*\\*(.*)\\*(.*)\\*(.\\d*.)\\*(.\\d*.).\\*(.\\d*.)\\*[ ]*#kasmasjid";

        // Create a Pattern object
        Pattern r_kas = Pattern.compile(pattern_kas);

        // Now create matcher object.
        Matcher m_kas = r_kas.matcher(tweet);

        if (m_kas.find() && info.equals("kas")) {
            String[] a = {m_kas.group(0), m_kas.group(1), m_kas.group(2), m_kas.group(3), m_kas.group(4), m_kas.group(5)};
            return a;
        } else {
            String[] a = {"error"};
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
       // t.userMention();
//        int a = t.cek_minggu("Tue Jun 23 13:15:10 ICT 2015");
//        System.out.println(a);
//        t.getLastFriday();

    }

}
