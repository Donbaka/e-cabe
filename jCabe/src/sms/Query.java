/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package sms;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

/**
 *
 * @author elfatahwashere
 */
public class Query {

    private static final String database = "jdbc:mysql://localhost/cabe";
    private static final String username = "root";
    private static final String password = "";
    //inisialisasi SQL serta command untuk ke database
    private static String SQL;
    private static Connection con;
    private static Statement stm;
    private static PreparedStatement pstmt;
    private static ResultSet rs;

    public void connect() {
        try {
            Class.forName("com.mysql.jdbc.Driver");
            con = DriverManager.getConnection(database, username, password);
            stm = con.createStatement();
        } catch (ClassNotFoundException | SQLException e) {
        }
    }
    public final String kabupaten = "SELECT ID_KABKOTA, NAMA FROM kabkota";
    public final String komoditas = "SELECT id, komoditas FROM komoditas";
    public final String kecamatan = "SELECT ID_KECAMATAN, NAMA FROM kecamatan WHERE ID_KABKOTA =";
    public final String cekSms = "SELECT ID, TextDecoded, SenderNumber FROM inbox WHERE Replied =0";
    public final String updateSms = "UPDATE `inbox` SET `Replied`=1 WHERE `ID` =";
    public final String cekDaftar = "SELECT nomor_hp FROM petani WHERE nomor_hp =";
        public final String cekPetani = "SELECT id FROM petani WHERE nomor_hp =";

    public final String insertHargaPetani = "INSERT INTO `cabe`.`harga_petani` (`id_komoditas`, `id_petani`, `harga`, `stok`) VALUES ('3', '1', '123132', '123213');";

}
