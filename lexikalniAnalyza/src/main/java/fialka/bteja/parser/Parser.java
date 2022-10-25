/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package fialka.bteja.parser;

import fialka.bteja.token.Token;
import java.util.ArrayList;
import java.util.LinkedList;

/** 
 *
 * @author fialk
 */
public class Parser {

    LinkedList<Token> tokens;
    private int current = 0;

    public Parser(LinkedList<Token> tokens) {
        this.tokens = tokens;
    }

    private Expression expression() {
        return equality();
    }

    private Expression equality() {
        Expression expr = comparison();
        while (match(BANG_EQUAL, EQUAL_EQUAL)) {
            Token operator = previous();
            Expression right = comparison();
            expr = new Expression().Binary(expr, operator, right);
        }
        return expr;
    }

    private Token getNextToken() {
        return tokens.get(++current);
    }

    private Token showNextToken() {
        return tokens.get(current + 1);
    }
}
