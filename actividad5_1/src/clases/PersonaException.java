package clases;

public class PersonaException extends Exception{
    public String errorMessage;

    public PersonaException(){
        this.errorMessage="Error indefinido";
    }

    public PersonaException(String mensaje){
        this.errorMessage= mensaje;
    }
}
