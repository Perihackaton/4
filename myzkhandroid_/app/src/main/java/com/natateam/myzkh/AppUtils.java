package com.natateam.myzkh;

import android.text.Editable;

/**
 * Created by macbook on 22/06/ 15.
 */
public class AppUtils {

    public static String FormatStringAsPhoneNumber(String input) {
        String output;
        switch (input.length()) {
            case  0:{
                output=input;
                break;
            }
            case 1:{
                output=String.format("%sXX-XXX-XX-XX", input.substring(0,1));;
                break;
            }
            case 2:{
                output=String.format("%sX-XXX-XX-XX", input.substring(0,2));
                break;
            }
            case 3:
                output = String.format("%s-XXX-XX-XX", input.substring(0,3));
                break;
            case 4:{
                output = String.format("%s-%sXX-XX-XX", input.substring(0,3),input.substring(3));
                break;
            }
            case 5:{
                output = String.format("%s-%sX-XX-XX", input.substring(0,3),input.substring(3));
                break;
            }
            case 6: {
                output = String.format("%s-%s-XX-XX", input.substring(0, 3), input.substring(3));
                break;
            }
            case 7:{
                output = String.format("%s-%s-%sX-XX", input.substring(0,3),input.substring(3,6),input.substring(6));
                break;
            }
            case 8:{
                output = String.format("%s-%s-%s-XX", input.substring(0,3),input.substring(3,6),input.substring(6));
                break;
            }
            case  9:{
                output = String.format("%s-%s-%s-%sX", input.substring(0,3),input.substring(3,6),input.substring(6,8),input.substring(8,9));
                break;
            }
            case 10: {
                output = String.format("%s-%s-%s-%s", input.substring(0, 3), input.substring(3, 6), input.substring(6, 8), input.substring(8,10));
                break;
            }
            default:
                output=null;
                break;

        }
        return output;
    }

    public static int getSelectionForNumber(int count){
        if (count==1||count==3||count==2||count==10){
            return count;
        }

        if (count==4||count==5||count==6){
            return count+1;
        }

        if (count==7||count==8){
            return count+2;
        }

        if (count==9||count==10){
            return count+3;
        }
        return 0;

    }

    public static boolean isEmpty(Editable value) {
        return value == null || isEmpty(value.toString());
    }

    public static boolean isEmpty(String value) {
        return (value == null || value.trim().length() == 0);
    }

    public static boolean isEmpty(CharSequence value) {
        return value == null || isEmpty(value.toString());
    }


    public final static boolean isValidEmail(CharSequence target) {
        if (target == null) {
            return false;
        } else {
            return android.util.Patterns.EMAIL_ADDRESS.matcher(target).matches();
        }


    }
}
