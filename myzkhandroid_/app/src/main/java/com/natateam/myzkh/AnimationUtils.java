package com.natateam.myzkh;

import android.view.animation.AlphaAnimation;
import android.view.animation.Animation;

/**
 * Created by macbook on 30/01/ 15.
 */
public class AnimationUtils {
    public static Animation getFadeInAnimation(){
        Animation animation1 = new AlphaAnimation(0.0f, 1.0f);
        animation1.setDuration(1000);
        return animation1;
    }

    public static Animation getFadeOutAnimation(){
        Animation animation2 = new AlphaAnimation(1.0f, 0.0f);
        animation2.setDuration(1000);
        return animation2;
    }
}
