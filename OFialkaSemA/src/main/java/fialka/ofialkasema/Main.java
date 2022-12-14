package fialka.ofialkasema;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.LinkedList;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author fialk
 */
public class Main {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws IOException {
        // TODO code application logic here
        int pocetSimulaci = 0;
        double vsechnyCeny = 0.0, prumernaCena = 0.0;

        double smerOdchylka1, smerOdchylka2 = 1000;
        
        LinkedList<Long> cenySimulaci = new LinkedList();

        do {
            Simulace sim = new Simulace();
            sim.spocitejCennyCest();
            long nejlevnejsiCesta = Math.round(sim.getNejlevnejsiCestu());
            vsechnyCeny += nejlevnejsiCesta;
            cenySimulaci.add(nejlevnejsiCesta);
            pocetSimulaci++;
            prumernaCena = vsechnyCeny / pocetSimulaci;
            smerOdchylka1 = smerOdchylka2;
            smerOdchylka2 = spocitejOdchylku(cenySimulaci, prumernaCena);
            System.out.println("prvni: " + smerOdchylka1 + " druha: " + smerOdchylka2 + "rozdil: " +  Math.abs(smerOdchylka1 - smerOdchylka2));
        } while (Math.abs(smerOdchylka1 - smerOdchylka2) > 0.0000001);
        zapisCeny(cenySimulaci);
        System.out.println(pocetSimulaci);
        System.out.println("prumerna cena projektu: " + Math.round(prumernaCena) * 1000 + " Kč,-");
    }

    private static void zapisCeny(LinkedList<Long> list) throws IOException {
        File f = new File("./hodnoty.csv");
        FileWriter fw = new FileWriter(f);
        fw.write("Reálný rozpočet projektu [v tisících Kč];pravděpodobnost[%]\n");

        for (int i = 17; i < 51; i++) {
            double procenta = Math.floor((getPercentage(i, list) * 100)) / 100;
            if (procenta > 0.009) {
                fw.write(i + ";" + String.valueOf(procenta).replace(".", ",") + "\n");
            }
        }
        
        fw.close();
    }

    private static double getPercentage(int cena, LinkedList<Long> list) {
        long pocetVyskytuCeny = getPocetVyskytuCeny(cena, list);
        double jedenVyskytVProcentech = 100.0 / list.size();
        return (pocetVyskytuCeny * jedenVyskytVProcentech);
    }

    private static long getPocetVyskytuCeny(int cena, LinkedList<Long> list) {
        int count = 0;
        for (long t : list) {
            if (t == cena) {
                count++;
            }
        }
        return count;
    }

    private static double spocitejOdchylku(LinkedList<Long> list, double prumer) {
        double pom = 0;
        for (long cena : list) {
            pom += Math.pow(cena - prumer, 2);
        }
        double rozptyl = (pom/list.size());
        return Math.sqrt(rozptyl);
    }
}