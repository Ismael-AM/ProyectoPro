package main;

import java.awt.BorderLayout;
import java.awt.Color;

import clases.Inicio;

public class actividad5_1 {
        
    private static Inicio inicio;
    
    private static void initComponents() {
        inicio = new Inicio();
    }
      
    public static void main(String[] args) {
        initComponents();
        inicio.setSize(1000, 700);
        inicio.setResizable(false);
        inicio.pack();
        inicio.setLocationRelativeTo(null);
        inicio.getContentPane().setLayout(new BorderLayout());
        inicio.getContentPane().setBackground(new Color(60,63,65) );
        inicio.setVisible(true);
    }
}