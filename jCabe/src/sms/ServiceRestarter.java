/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package sms;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author brlnt-super
 */
public class ServiceRestarter {
    public void restart(String service){
        Runtime runtime= Runtime.getRuntime();
        String command = "net stop \""+service+"\" \n net start \""+service+"\"";
        
        Process run;
        try {
            run = runtime.exec(command);
            run.waitFor();
            
            String line = "";
            BufferedReader buf = new BufferedReader( new InputStreamReader( run.getInputStream()));
            while( ( line = buf.readLine()) != null){
                System.out.println(line);
            }
        } catch (IOException ex) {
            Logger.getLogger(ServiceRestarter.class.getName()).log(Level.SEVERE, null, ex);
        } 
        catch (InterruptedException ex) {
            Logger.getLogger(ServiceRestarter.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        
        System.out.println(command);
    }
    
//    public static void main(String args[]){
//        new ServiceRestarter().restart("GammuSMSD");
//    }
}
