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
        double vsechnyCeny = 0;
        double prumernaCena = 0;

        LinkedList<Long> cenySimulaci = new LinkedList();

        while (pocetSimulaci < 100000) {
            Simulace sim = new Simulace();
            sim.spocitejCennyCest();
            long nejlevnejsiCesta = Math.round(sim.getNejlevnejsiCestu());
            vsechnyCeny += nejlevnejsiCesta;
            cenySimulaci.add(nejlevnejsiCesta);
            prumernaCena = vsechnyCeny / pocetSimulaci;
            pocetSimulaci++;
        }
        zapisCeny(cenySimulaci);
        System.out.println("prumerna cena projektu: " + Math.round(prumernaCena) * 1000 + " Kč,-");

    }

    private static void zapisCeny(LinkedList<Long> list) throws IOException {
        File f = new File("./hodnoty.csv");
        FileWriter fw = new FileWriter(f);
        fw.write("Reálný rozpočet projektu [v tisících Kč];pravděpodobnost[%]\n");
        
        
        for (int i = 17; i < 51; i++) {
            double procenta = Math.floor((getPercentage(i, list)*100))/100;
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
}
