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
import java.text.ParseException;

public class Twit {

    /**
     * @param args the command line arguments
     */
    //inisialisasi data untuk menyambungkan ke database
    private static String database = "jdbc:mysql://localhost/cabe";
    private static String username = "root";
    private static String password = "";
    //inisialisasi SQL serta command untuk ke database
    private static String SQL;
    private static Connection con;
    private static Statement stm;
    private static ResultSet rs;
    //inisialisasi class JaroWinkler
    JaroWinkler JW = new JaroWinkler();
    Query query = new Query();
    // Harga harga = new Harga();
    Location lokasi = new Location();

    public String[] Regex(String tweet) {
        // String to be scanned to find the pattern.
        // Format tweet
        String pattern_harga_masyarakat = "^\\@tahupongcode[ ]HARGA[ ]*(.*)\\#(.*.)\\#(.\\d*.)";
        String pattern_keluhan = "^\\@tahupongcode[ ]KELUHAN[ ]*(.*)\\#(.*.)\\#(.*.)";

        // Create a Pattern object
        Pattern r_harga_masyarakat = Pattern.compile(pattern_harga_masyarakat.replace("\\HARGA", "HARGA"));
        Pattern r_keluhan_masyarakat = Pattern.compile(pattern_keluhan.replace("\\KELUHAN", "KELUHAN"));
        // Now create matcher object.
        Matcher harga_masyarakat = r_harga_masyarakat.matcher(tweet);
        Matcher keluhan_masyarakat = r_keluhan_masyarakat.matcher(tweet);

        if (harga_masyarakat.find()) {
            String[] a = {"harga", harga_masyarakat.group(0), harga_masyarakat.group(1), harga_masyarakat.group(2), harga_masyarakat.group(3)};
            return a;
        } else if (keluhan_masyarakat.find()) {
            //subject keluhan id_kabupaten
            String[] a = {"keluhan", keluhan_masyarakat.group(0), keluhan_masyarakat.group(1), keluhan_masyarakat.group(2), keluhan_masyarakat.group(3)};
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

    public String cekTitik(String titik) throws SQLException {
        connect();
        ResultSet result = stm.executeQuery(query.cekTitik + "'" + titik + "'");
        double similarity = 0;
        String id_kab = "";
        //boolean status = true;
        while (result.next()) {
            // status = false;
            double new_similarity = JW.compare(titik, result.getString("nama"));
            if (new_similarity > similarity) {
                similarity = new_similarity;
                if (similarity > 0.8) {
                    id_kab = result.getString("id");
                } else {
                    id_kab = "false";
                }
            }
        }
        return id_kab;
    }

    public int cekKomoditas(String komoditas) throws SQLException {
        connect();
        ResultSet result = stm.executeQuery(query.komoditas);
        double similarity = 0;
        int id_komoditas = 0;
        while (result.next()) {
            double new_similarity = JW.compare(komoditas, result.getString("komoditas"));
            if (new_similarity > similarity) {
                similarity = new_similarity;
                if (similarity > 0.8) {
                    id_komoditas = result.getInt("id");
                } else {
                    id_komoditas = 0;
                }
            }
        }
        return id_komoditas;
    }

    public String cekMasyarakat(String USER) throws SQLException {
        connect();
        ResultSet result = stm.executeQuery("SELECT id FROM hp_masyarakat WHERE nomor_hp ='" + USER + "'");
        String idMasyarakat = "";
        while (result.next()) {
            idMasyarakat = result.getString("id");
        }
        return idMasyarakat;
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

    public void insertKeluhan(String id_masyarakat, String subject, String keluhan, String id_kabupaten) throws SQLException {
        connect();
        stm.executeUpdate("INSERT INTO `keluhan` (`id_masyarakat`, `subject`, `keluhan`, `id_kabupaten`) VALUES ('" + id_masyarakat + "', '" + subject + "', '" + keluhan + "', '" + id_kabupaten + "');");

        // pstmt.executeUpdate(query.updateSms);
    }

    public static void onStatus(Status status, int kode) {
        Twitter tf = new TwitterFactory().getInstance();
        //kode 1 : Format benar
        if (kode == 1) {
            StatusUpdate st = new StatusUpdate("Hi @" + status.getUser().getScreenName() + ", terima kasih telah membantu monitoring harga Cabe Indonesia :D");
            st.inReplyToStatusId(status.getId());
            try {
                tf.updateStatus(st);
            } catch (TwitterException e) {
                // TODO Auto-generated catch block
                e.printStackTrace();
            }
            //kode 2 : Format salah
        } else if (kode == 2) {
            StatusUpdate st = new StatusUpdate("Hi @" + status.getUser().getScreenName() + ", terima kasih atas laporan Anda! :)");
            st.inReplyToStatusId(status.getId());
            try {
                tf.updateStatus(st);
            } catch (TwitterException e) {
                // TODO Auto-generated catch block
                e.printStackTrace();
            }
            //kode 2 : Format salah
        } else {
            System.out.println("error");
        }
    }

    public void userMention() throws SQLException, ParseException {
        Twitter twitter = new TwitterFactory().getInstance();
        try {
            Long since_id = cek_last_mention();
            Paging paging = new Paging().sinceId(since_id);
            List<Status> statuses = twitter.getMentionsTimeline(paging);
            for (twitter4j.Status status : statuses) {
                long ID_TWEET = status.getId();
                String USERNAME = status.getUser().getScreenName();
                String TWEET = status.getText().replace("'", "\\'");
                save_user(USERNAME);
                String ID_MASYARAKAT = cekMasyarakat(USERNAME);
                if (USERNAME.equals("tahupongcode")) { //reply akun sendiri
                    save_data_mentions(ID_TWEET);
                } else {
                    if (Regex(TWEET)[0].equals("harga")) {
                        //masukkan hasil regex pada array
                        String[] hasil = Regex(TWEET);
                        //ambil isi array
                        int KOMODITAS = cekKomoditas(hasil[2]);
                        String TITIK_DISTRIBUSI = cekTitik(hasil[3]);
                        String HARGA = hasil[4];
                        save_harga(KOMODITAS, TITIK_DISTRIBUSI, ID_MASYARAKAT, USERNAME, HARGA);
                        if (cek_replied(ID_TWEET) == false) {
                            save_data_mentions(ID_TWEET);
                            onStatus(status, 1);
                        }
                    } else if (Regex(TWEET)[0].equals("keluhan")) {
                        //masukkan hasil regex pada array
                        String[] hasil = Regex(TWEET);
                        //ambil isi array
                        String SUBJECT = hasil[2];
                        String KELUHAN = hasil[3];
                        String KABUPATEN = cekKabupaten(hasil[4]);
                        insertKeluhan(ID_MASYARAKAT, SUBJECT, KELUHAN, KABUPATEN);
                        if (cek_replied(ID_TWEET) == false) {
                            save_data_mentions(ID_TWEET);
                            onStatus(status, 2);
                        }
                    } else {
                        System.out.println("error");
                    }
                }
            }
        } catch (TwitterException te) {
            te.printStackTrace();
            System.out.println("Failed to get timeline: " + te.getMessage());
            System.exit(-1);
        }
    }

    public boolean cek_replied(long ID_TWEET) throws SQLException {
        String q_rep = "SELECT * FROM tweet WHERE tweet=" + ID_TWEET;
        connect();
        rs = stm.executeQuery(q_rep);
        if (rs.next()) {
            return true; //sudah di-reply
        } else {
            return false; //belum di-reply
        }
    }

    public Long cek_last_mention() throws SQLException {
        Long TWIT_ID = null;
        String q_mentions = "SELECT tweet, tanggal FROM tweet ORDER BY tanggal DESC LIMIT 1";
        connect();
        rs = stm.executeQuery(q_mentions);
        while (rs.next()) {
            TWIT_ID = rs.getLong("tweet");
        }
        return TWIT_ID;
    }

    public void save_data_mentions(long ID_TWEET) throws SQLException {
        connect();
        String SQL_mentions = "INSERT INTO `tweet`(`tweet`) VALUES ('" + ID_TWEET + "')";
        stm.executeUpdate(SQL_mentions);
    }

    public void save_harga(int KOMODITAS, String TITIK_DISTRIBUSI, String ID_MASYARAKAT, String USERNAME, String HARGA) throws SQLException {
        connect();
        stm.executeUpdate("INSERT INTO `harga_distribusi` (`id_komoditas`, `id_masyarakat`,`id_titik`, `harga`) VALUES ('" + KOMODITAS + "','" + ID_MASYARAKAT + "', '" + TITIK_DISTRIBUSI + "', '" + HARGA + "');");

        // pstmt.executeUpdate(query.updateSms);
    }

    public void save_user(String USERNAME) throws SQLException {
        String q_savetweet = "SELECT `id` FROM `hp_masyarakat` WHERE nomor_hp='" + USERNAME + "'";
        connect();
        rs = stm.executeQuery(q_savetweet);
        String id_tweet = "";
        if (!rs.next()) {
            String add_user = "INSERT INTO `hp_masyarakat`(`nomor_hp`) "
                    + "VALUES ('" + USERNAME + "')";
            stm.executeUpdate(add_user);
        }
    }

    public static void main(String[] args) throws SQLException, ParseException {
        Twit t = new Twit();
        t.userMention();
    }

}
