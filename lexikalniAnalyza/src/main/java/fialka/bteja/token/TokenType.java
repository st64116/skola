/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Enum.java to edit this template
 */
package fialka.bteja.token;

/**
 *
 * @author fialk
 */
public enum TokenType {
    KEY("klíčové slovo"),
    NUMBER("číslo"),
    IDENTIFIER("identifikátor"),
    SEPARATOR("oddělovač"),
    OPERATOR("operátor"),
    NONE("");

    private final String nazev;

    private TokenType(String nazev) {
        this.nazev = nazev;
    }
    
    
    
}
