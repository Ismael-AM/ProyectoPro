package clases;
import java.util.*;

public class Persona {
    private String id;
    private String nombre;
    private String apellido1;
    private String apellido2;
    private String añoNac;
    private String correo;
    private String contraseña;
    
    Scanner teclado= new Scanner(System.in);
    boolean isEmpty, isInt, isEmail, isTaken;
    
    public void setID(ArrayList<Persona> people){
        do{
            System.out.print(" Introduzca el ID: ");
            String comp=teclado.nextLine();
            isEmpty=comp.matches("");
            for(int i=0; i<people.size();i++){
                isTaken=comp.matches(String.valueOf(people.get(i).getID()));
                if(isTaken){
                    break;
                }
            }
            isInt=comp.matches("[0-9]*");
            try{
                if(isEmpty){
                    throw new PersonaException("Error. Debe introducir un número de identificación" + "\n");
                }else if(!isInt){
                    throw new PersonaException("Error. El ID debe ser un número entero." + "\n");
                }else if(isTaken){
                    throw new PersonaException("Error. El ID introducido no está disponible. Por favor, introduzca otro." + "\n");
                }else{
                    this.id =comp;
                }
            }catch(PersonaException e){
                System.out.println("\n Mensaje: "+e.errorMessage);
            }
        }while(isEmpty || !isInt || isTaken);
    }
    public void setID(String id){
        this.id=id;
    }
    public String getID(){
        return id;
    }

    public void setNombre(){
        do{
            System.out.print(" Introduzca el nombre: ");
            String comp=teclado.nextLine();
            isEmpty=comp.matches("");
            try{
                if(isEmpty){
                    throw new PersonaException("Error. Debe introducir un nombre." + "\n");
                }else{
                    this.nombre =comp;
                }
            }catch(PersonaException e){
                System.out.println("\n Mensaje: "+e.errorMessage);
            }
        }while(isEmpty);
    }
    public void setNombre(String nombre){
        this.nombre=nombre;    
    }
    public String getNombre(){
        return nombre;
    }

    public void setApellido1(){
        do{
            System.out.print(" Introduzca los apellidos: ");
            String comp=teclado.nextLine();
            isEmpty=comp.matches("");
            try{
                if(isEmpty){
                    throw new PersonaException("Error. Debe introducir el primer apellido." + "\n");
                }else{
                    this.apellido1 =comp;
                }
            }catch(PersonaException e){
                System.out.println("\n Mensaje: "+e.errorMessage);
            }
        }while(isEmpty);
    }
    public void setApellido1(String apellido1){
        this.apellido1=apellido1;
    }
    public String getApellido1(){
        return apellido1;
    }
    
    public void setApellido2(){
        System.out.print(" Introduzca los apellidos: ");
        String comp=teclado.nextLine();
        this.apellido2 =comp;
    }
    
    public void setApellido2(String apellido2){
        this.apellido2=apellido2;
    }
    public String getApellido2(){
        return apellido2;
    }

    public void setAñoNac(){
        do{
            System.out.print(" Introduzca el año de nacimiento: ");
            String comp=teclado.nextLine();
            isEmpty=comp.matches("");
            isInt=comp.matches("[0-9]*");
            try{
                if(isEmpty){
                    throw new PersonaException("Error. Debe introducir el año de nacimiento." + "\n");
                }else if(!isInt){
                    throw new PersonaException("Error. El dato a introducir debe ser un número entero." + "\n");
                }else{
                    this.añoNac=comp;
                }
            }catch(PersonaException e){
                System.out.println("\n Mensaje: "+e.errorMessage);
            }
        }while(isEmpty || !isInt);
    }
    public void setAñoNac(String año){
        this.añoNac=año;
    }
    public String getAñoNac(){
        return añoNac;
    }

    public void setCorreo(){
        do{
            System.out.print(" Introduzca el correo: ");
            String comp=teclado.nextLine();
            String gmail="@gmail.com";
            String hotmail="@hotmail.com";
            isEmail=comp.contains(gmail)||comp.contains(hotmail);
            isEmpty=comp.matches("");
            try{
                if(isEmpty){
                    throw new PersonaException("Error. Debe introducir una dirección de correo electrónico." + "\n");
                }else if(!isEmail){
                    throw new PersonaException("Error. El correo debe finalizar en @gmail.com o @hotmail.com." + "\n");
                }else{
                    this.correo =comp;
                }
            }catch(PersonaException e){
                System.out.println("\n Mensaje: "+e.errorMessage);
            }
        }while(isEmpty || !isEmail);
    }
    public void setCorreo(String correo){
        this.correo=correo;
    }
    public String getCorreo(){
        return correo;
    }
    
    public void setContraseña(String contraseña){
        this.contraseña=contraseña;
    }
    public String getContraseña(){
        return contraseña;
    }
    
    public void añadirPersona (ArrayList<Persona> people){
        setID(people); System.out.print("\n");
        setNombre(); System.out.print("\n");
        setApellido1(); System.out.print("\n");
        setApellido2(); System.out.print("\n");
        setAñoNac(); System.out.print("\n");
        setCorreo();
    }

    public void mostrarLista(){
        System.out.print("\n ID: " + getID() + "\n");
        System.out.print(" NOMBRE: " + getNombre() + "\n");
        System.out.print(" APELLIDO 1: " + getApellido1() + "\n");
        System.out.print(" APELLIDO 2: " + getApellido2() + "\n");
        System.out.print(" AÑO DE NAC.: " + getAñoNac() + "\n");
        System.out.print(" CORREO: " + getCorreo() +"\n");
    }
}