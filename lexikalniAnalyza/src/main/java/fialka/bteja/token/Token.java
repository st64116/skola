/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package fialka.bteja.token;

/**
 *
 * @author fialk
 */
public class Token {
    private final TokenType Type;
    private final String value;

    public Token(TokenType Type, String value) {
        this.Type = Type;
        this.value = value;
    }

    public TokenType getType() {
        return Type;
    }

    public String getValue() {
        return value;
    }

    @Override
    public String toString() {
        return "Token{" + "Type=" + Type + ", value=" + value + '}';
    }
    
    
    
}
