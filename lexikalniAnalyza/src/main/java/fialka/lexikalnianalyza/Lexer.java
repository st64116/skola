/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package fialka.lexikalnianalyza;

import fialka.lexikalnianalyza.token.Token;
import fialka.lexikalnianalyza.token.TokenType;
import java.util.LinkedList;

/**
 *
 * @author fialk
 */
public class Lexer {

    LinkedList<Token> tokens = new LinkedList<>();
    int index = 0;

    public Lexer() {
    }

    private String[] keys = {
        "CONST",
        "VAR",
        "PROCEDURE",
        "CALL",
        "BEGIN",
        "END",
        "IF",
        "THEN",
        "WHILE",
        "DO",
        "ODD",};

    private String[] operators = {
        "?",
        "!",
        "=",
        ":=",
        "<=",
        "=>",
        "<",
        ">",
        "+",
        "-",
        "*",
        "#",};

    private String[] separators = {
        ",",
        ";",
        "/",
        "(",
        ")",
        ".",};

    public LinkedList<Token> tokenize(String code) {
        index = 0;
        tokens = new LinkedList<>();

        while (index < code.length()) {

            String str = code.substring(index);
            if (str.startsWith(" ")) {
                index++;
                continue;
            }
            if (str.startsWith("\n")) {
                index += 2;
                continue;
            }

            boolean isOperator = checkForOperator(str);
            boolean isSeparator = checkForSeparator(str);
            boolean isKey = checkForKey(str);

            if (isOperator || isSeparator || isKey) {
                continue;
            }

            if (Character.isDigit(str.charAt(0))) {
                String number = "";
                int i = 0;
                while ((Character.isDigit(str.charAt(i)) || str.charAt(i) == '.') && i < str.length()) {
                    number += str.charAt(i);
                    index++;
                    i++;
                }
                tokens.add(new Token(TokenType.NUMBER, number));
                continue;
            }

            if (Character.isAlphabetic(str.charAt(0))) {
                String ident = "";
                int i = 0;
                while (Character.isAlphabetic(str.charAt(i)) && i < str.length()) {
                    ident += str.charAt(i);
                    index++;
                    i++;
                }
                tokens.add(new Token(TokenType.IDENTIFIER, ident));
                continue;
            }

        }

        return tokens;
    }

    private boolean checkForOperator(String str) {
        for (String operator : operators) {
            if (str.startsWith(operator)) {
                tokens.add(new Token(TokenType.OPERATOR, operator));
                index += operator.length();
                return true;
            }
        }
        return false;
    }

    private boolean checkForSeparator(String str) {
        for (String separator : separators) {
            if (str.startsWith(separator)) {
                tokens.add(new Token(TokenType.SEPARATOR, separator));
                index += separator.length();
                return true;
            }
        }
        return false;
    }

    private boolean checkForKey(String str) {
        for (String key : keys) {
            if (str.startsWith(key)) {
                tokens.add(new Token(TokenType.KEY, key));
                index += key.length();
                return true;
            }
        }
        return false;
    }

}
