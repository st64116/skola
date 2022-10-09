/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package fialka.ofialkasema;

/**
 *
 * @author fialk
 */
public final class Simulace {

    private double cesta1;
    private double cesta2;
    private double cesta3;
    
    private double cinnost1;
    private double cinnost2;
    private double cinnost3;
    private double cinnost4;
    private double cinnost5;
    private double cinnost6;
    private double cinnost7;
    private double cinnost8;
    private double cinnost9;

    public Simulace() {
        spocitejCinnosti();
        spocitejCennyCest();
    }

    public void spocitejCennyCest() {
        this.cesta1 = spocitejCestu1();
        this.cesta2 = spocitejCestu2();
        this.cesta3 = spocitejCestu3();
    }

    public double getNejlevnejsiCestu() {
        if (cesta1 > cesta2) {
            if (cesta2 > cesta3) {
                return cesta3;
            } else {
                return cesta2;
            }
        } else {
            if (cesta1 > cesta3) {
                return cesta3;
            } else {
                return cesta1;
            }
        }
    }

    public double spocitejCestu1() {
        return cinnost1+cinnost2+cinnost4+cinnost7+cinnost9;
    }

    public double spocitejCestu2() {
        return cinnost1+cinnost3+cinnost6+cinnost7+cinnost9;
    }

    public double spocitejCestu3() {
        return cinnost1+cinnost3+cinnost5+cinnost8+cinnost9;
    }

    private void spocitejCinnosti(){
    this.cinnost1 = Cinnosti.getCinnost1();
    this.cinnost2 = Cinnosti.getCinnost2();
    this.cinnost3 = Cinnosti.getCinnost3();
    this.cinnost4 = Cinnosti.getCinnost4();
    this.cinnost5 = Cinnosti.getCinnost5();
    this.cinnost6 = Cinnosti.getCinnost6();
    this.cinnost7 = Cinnosti.getCinnost7();
    this.cinnost8 = Cinnosti.getCinnost8();
    this.cinnost9 = Cinnosti.getCinnost9();
    }
    
}
