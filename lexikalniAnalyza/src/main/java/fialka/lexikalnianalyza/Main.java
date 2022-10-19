/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package fialka.lexikalnianalyza;

import fialka.lexikalnianalyza.token.Token;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.LinkedList;

/**
 *
 * @author fialk
 */
public class Main {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws FileNotFoundException, IOException {
        // TODO code application logic here
        String code = getCode();
        Lexer lexer = new Lexer();
        LinkedList<Token> tokens = lexer.tokenize(code);
        tokens.forEach(token -> System.out.println(token));
    }

    public static String getCode() throws FileNotFoundException, IOException {
        FileReader fr = new FileReader(new File("./src/main/java/assets/code.txt"));
        BufferedReader br = new BufferedReader(fr);
        String code = "";
        String line = "";
        while (line != null) {
            line = br.readLine();
            if (line != null) {
                code += line;
            }
        }
        return code;
    }

}
