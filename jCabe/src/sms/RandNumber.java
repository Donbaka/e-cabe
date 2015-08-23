/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package sms;

import java.util.HashSet;
import java.util.Random;
import java.util.Set;

/**
 *
 * @author elfatahwashere
 */
public class RandNumber {
     public static final int SET_SIZE_REQUIRED = 1;
    public static final int NUMBER_RANGE = 100000;

    public static void main(String[] args) {
        Random random = new Random();

        Set set = new HashSet<>(SET_SIZE_REQUIRED);

        while(set.size()< SET_SIZE_REQUIRED) {
            while (set.add(random.nextInt(NUMBER_RANGE)) != true)
                ;
        }
        assert set.size() == SET_SIZE_REQUIRED;
        System.out.println(set);
    }
}
