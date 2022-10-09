/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package fialka.ofialkasema;

import java.util.Random;

/**
 *
 * @author fialk
 */
public class Cinnosti {

    public static double getCinnost1() {
        Random rnd = new Random();
        int low = 5;
        int high = 11;
        int result = rnd.nextInt(high - low) + low;
        return result;
    }

    public static double getCinnost2() {
        Random rnd = new Random();
        int low = 1;
        int high = 11;
        int result = rnd.nextInt(high - low) + low;

        if (result == 1) {
            return 5;
        } else if (result > 1 && result < 4) {
            return 8;
        } else {
            return 10;
        }
    }

    public static double getCinnost3() {
        Random rnd = new Random();
        return rnd.nextGaussian(4, 1);
    }

    public static double getCinnost4() {
        Random rnd = new Random();
        return rnd.nextGaussian(12, 2);
    }

    public static double getCinnost5() {
        Random rnd = new Random();
        int low = 1;
        int high = 11;
        int result = rnd.nextInt(high - low) + low;
        if (result <= 6) {
            return (rnd.nextInt(6 - 3) + 3);
        } else if (result > 6 && result < 8) {
            return (rnd.nextInt(8 - 6) + 6);
        } else {
            return (rnd.nextInt(10 - 8) + 8);
        }
    }

    public static double getCinnost6() {
        Random rnd = new Random();
        return rnd.nextGaussian(10, 3);
    }

    public static double getCinnost7() {
        return 3;
    }

    public static double getCinnost8() {
        Random rnd = new Random();
        int low = 1;
        int high = 11;
        int result = rnd.nextInt(high - low) + low;
        if (result <= 3) {
            return 1;
        } else if (result > 3 && result < 9) {
            return rnd.nextInt(6 - 2) + 2;
        } else {
            return 7;
        }
    }

    public static double getCinnost9() {
        Random rnd = new Random();
        return rnd.nextGaussian(11, 2);
    }

}
