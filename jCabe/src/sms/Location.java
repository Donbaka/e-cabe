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
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.Reader;
import java.net.URL;
import java.nio.charset.Charset;

import org.json.JSONException;
import org.json.JSONObject;

public class Location {

    private static String readAll(Reader rd) throws IOException {
        StringBuilder sb = new StringBuilder();
        int cp;
        while ((cp = rd.read()) != -1) {
            sb.append((char) cp);
        }
        return sb.toString();
    }

    public static JSONObject readJsonFromUrl(String url) throws IOException, JSONException {
        InputStream is = new URL(url).openStream();
        try {
            BufferedReader rd = new BufferedReader(new InputStreamReader(is, Charset.forName("UTF-8")));
            String jsonText = readAll(rd);
            JSONObject json = new JSONObject(jsonText);
            return json;
        } finally {
            is.close();
        }
    }
//
//    public static void main(String[] args) throws IOException, JSONException {
//        Location lok = new Location();
//        System.out.println(lok.getLatLong("pasar inpres subang subang")[3]);
//    //    System.out.println(lok.getLatLong("pasar inpres subang subang")[1]);
//        //  getLatLong();
////        String haha = "saya hilman ganteng sekali";
////        System.out.println(haha.replace(' ', '+'));
//    }

    public String[] getLatLong(String keyword) throws IOException, JSONException {
        keyword = keyword.replace(' ', '+');
        JSONObject json = readJsonFromUrl("https://maps.googleapis.com/maps/api/place/textsearch/json?query=" + keyword + "&key=AIzaSyC0uBBOxaowSCgydRApwp5qU_drp3ZicHo");
        String latlong[] = new String[3];
// JSONArray huhu = json.getJSONArray(json.getJSONObject("result"));
        //System.out.println(json.toString());
        String alamat = json.getJSONArray("results").getJSONObject(0).getString("formatted_address");
        //return alamat;
        String latitude = json.getJSONArray("results").getJSONObject(0).getJSONObject("geometry").getJSONObject("location").getString("lat");
        String longitude = json.getJSONArray("results").getJSONObject(0).getJSONObject("geometry").getJSONObject("location").getString("lng");
        latlong[0] = latitude;
        latlong[1] = longitude;
        latlong[2] = alamat;
        return latlong;
        // System.out.println(latitude+" , "+ longitude);
    }
}
