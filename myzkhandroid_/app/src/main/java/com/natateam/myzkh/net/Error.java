package com.natateam.myzkh.net;


public class Error {
    public int code;
    public String message;
    public static   final int TOKEN_NOT_FOUND=4;

    public Error(String message, int code) {
        this.message = message;
        this.code = code;
    }
}
