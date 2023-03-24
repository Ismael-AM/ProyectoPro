package clases;

import java.util.ArrayList;
import javax.swing.table.AbstractTableModel;


public class TablaModeloPersona extends AbstractTableModel{
    
    private static final int ID = 0;
    private static final int NOMBRE = 1;
    private static final int APE1 = 2;
    private static final int APE2 = 3;
    private static final int FENAC = 4;
    private static final int CORREO = 5;
    private static final int PWD = 6;
    
    public ArrayList<Persona> listaPersonas;
    
    private static final String[] columns = new String[]{"ID", "Nombre", "Apellido1", "Apellido1", "Año Nac.", "Correo", "Password"};
    private static final Class<?>[] clase = {String.class, String.class, String.class, String.class, String.class, String.class, String.class};

    
    private String[] columnNames = {"ID", "Nombre", "Apellido1", "Apellido2", "Año_Nac", "Correo", "Password"};
    
    
    public TablaModeloPersona(ArrayList<Persona> listaPersonas){
        this.listaPersonas=listaPersonas;
    }
    
    @Override
    public int getRowCount() {
        return listaPersonas.size();
    }

    @Override
    public int getColumnCount() {
        return columns.length;
    }
    
    @Override  // Devuelve valor de la celda que s esta en la fila rowIndex y en la columna columnIndex
    public Object getValueAt(int rowIndex, int columnIndex) {
        Persona a = getPersona(rowIndex);

        if(a != null) {
            switch (columnIndex) {
                case ID -> {
                    return a.getID();
                }
                case NOMBRE -> {
                    return a.getNombre();
                }
                case APE1 -> {
                    return a.getApellido1();
                }
                case APE2 -> {
                    return a.getApellido2();
                }
                 case FENAC -> {
                     return a.getAñoNac();
                }
                case CORREO -> {
                    return a.getCorreo();
                }
                case PWD -> {
                    return a.getContraseña();
                }
               }
        }
        return "";
    }
    
    
    @Override  // Escribe valor en la celda que esta en la fila rowIndex y en la columna columnIndex
    public void setValueAt(Object valor,int rowIndex, int columnIndex) {
        Persona a = getPersona(rowIndex);

        if(a != null) {
            switch (columnIndex) {
                case ID:
                    a.setID(valor.toString());
                case NOMBRE:
                    a.setNombre(valor.toString());
                case APE1:
                    a.setApellido1(valor.toString());
                case APE2:
                    a.setApellido2(valor.toString());
                 case FENAC:
                    a.setAñoNac(valor.toString());
                case CORREO:
                    a.setCorreo(valor.toString());
                case PWD:
                    a.setContraseña(valor.toString());
               }
        }
       
    }
    
    public void setValueRow(Persona a,int rowIndex) {
        Persona modificar = getPersona(rowIndex);

        if(modificar != null) {
            modificar.setID(a.getID());
            modificar.setNombre(a.getNombre());
            modificar.setApellido1(a.getApellido1());
            modificar.setApellido2(a.getApellido2());
            modificar.setAñoNac(a.getAñoNac());
            modificar.setCorreo(a.getCorreo());
            modificar.setContraseña(a.getContraseña());
            this.fireTableDataChanged();
           }
    }
  
    public Persona getPersona(int rowIndex) {
        if (getRowCount() > rowIndex && rowIndex >= 0) {
            return listaPersonas.get(rowIndex);
        }
        return null;
    }

    public ArrayList<Persona> getlistaPersonas() {
        return listaPersonas;
    }

    public void setListaPersonas(ArrayList<Persona> listaPersonas) {
        this.listaPersonas = listaPersonas;
        this.fireTableDataChanged(); //informa que la tabla ha cambiado.
    }

    public void setPersona(Persona sb){
        listaPersonas.add(sb);
        this.fireTableRowsInserted(listaPersonas.size()-1, listaPersonas.size()-1);
    }
   @Override
    public Class<?> getColumnClass(int columnIndex) {
        return clase[columnIndex];
    }
    
    @Override 
    public String getColumnName(int index) { 
        return columnNames[index]; 
    } 

   
    public String[] getColumnNames() {
        return columnNames;
    }

    public void setColumnNames(String[] columnNames) {
        this.columnNames = columnNames;
    }
}