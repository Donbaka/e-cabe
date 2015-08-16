/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package sms;

/**
 *
 * @author elfatahwashere
 */
public class Query {

    public final String kabupaten = "SELECT ID_KABKOTA, NAMA FROM kabkota";
    public final String kecamatan = "SELECT ID_KECAMATAN, NAMA FROM kecamatan WHERE ID_KABKOTA =";
    public final String cekSms = "SELECT ID, TextDecoded, SenderNumber FROM inbox WHERE Replied =0";
    public final String updateSms = "UPDATE `inbox` SET `Replied`=1 WHERE `ID` =";
    public final String cekDaftar = "SELECT nomor_hp FROM petani WHERE nomor_hp =";

}
