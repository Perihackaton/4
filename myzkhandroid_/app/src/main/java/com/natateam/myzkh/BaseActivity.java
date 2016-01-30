package com.natateam.myzkh;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.app.ActionBarActivity;

import com.natateam.myzkh.fragments.BaseFragment;
import com.natateam.myzkh.fragments.MainFragment;
import com.natateam.myzkh.screens.AuthActivity;

/**
 * Created by macbook on 29/01/ 15.
 */
public class BaseActivity extends ActionBarActivity {

    protected String mPrevVisibleFragment, mCurrentVisibleFragment;
    boolean mWasBackPressed;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        final FragmentManager fm = getSupportFragmentManager();
        fm.addOnBackStackChangedListener(new FragmentManager.OnBackStackChangedListener() {
            @Override
            public void onBackStackChanged() {
                final int count = fm.getBackStackEntryCount();
                if (count == 0 && mWasBackPressed) {
                    finish();
                    return;
                } else {
                    if (count > 0) {
                        mCurrentVisibleFragment = fm.getBackStackEntryAt(count - 1).getName();
                        setFragmentByTag(mCurrentVisibleFragment, R.id.frag_content, true);
                    }
                }
            }
        });

        addFirstFragment(savedInstanceState);
    }

    public void setFragmentByTag(String tag, int content_id, boolean addToStack) {
        setFragmentByTag(tag, content_id, null, addToStack);
    }
    private void addFirstFragment(final Bundle savedState)
    {
        if (savedState == null)
        {
            if (this instanceof AuthActivity) {
                setFragmentByTag(AuthFragment.class.getName(), R.id.frag_content, true);
            }else {
                setFragmentByTag(MainFragment.class.getName(), R.id.frag_content, false);
            }
        }
        else
        {
            final FragmentManager fm = getSupportFragmentManager();
            if (fm != null && fm.getBackStackEntryCount() > 0)
            {
                final FragmentManager.BackStackEntry e = fm.getBackStackEntryAt(fm.getBackStackEntryCount() - 1);
                setFragmentByTag(e.getName(), R.id.frag_content, true);
                return;
            }
            if (this instanceof AuthActivity) {
                setFragmentByTag(AuthFragment.class.getName(), R.id.frag_content, true);
            }else {
                setFragmentByTag(MainFragment.class.getName(), R.id.frag_content, false);
            }
        }
    }

    public void setFragmentByTag(String name, int content_id, Bundle params, boolean addToStack) {
        if (mCurrentVisibleFragment == null || !mCurrentVisibleFragment.equals(name))
        {
            if (mCurrentVisibleFragment != null)
                mPrevVisibleFragment = new String(mCurrentVisibleFragment);
            mCurrentVisibleFragment = name;
        }
        final FragmentManager fm = getSupportFragmentManager();
        Fragment fragment;
        if (fm != null) {
            if (mPrevVisibleFragment != null && mPrevVisibleFragment.equals(name) && !mPrevVisibleFragment.equals(mCurrentVisibleFragment)) {
                return;
            }

            final FragmentTransaction ft = fm.beginTransaction();
            fragment = fm.findFragmentByTag(mPrevVisibleFragment);

            if (fragment != null)
                ft.hide(fragment);

            fragment = fm.findFragmentByTag(name);
            if (fragment == null) {
                fragment = instantinateFragment(name, params);
                if (fragment == null)
                    return;
                ft.add(content_id, fragment, name);

                ft.show(fragment);
                if (addToStack) // fm.getFragments() != null &&
                    ft.addToBackStack(name);
                ft.commitAllowingStateLoss();
            } else {
                ft.show(fragment);
                ft.commitAllowingStateLoss();
            }
        }
        setTitleByTag(name);

    }


    private Fragment instantinateFragment(final String name, final Bundle params) {
        Class cl = null;

        try {
            cl = Class.forName(name);
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
            return null;
        }

        Fragment fr = null;
        fr = BaseFragment.getInstance(cl, params);
        return fr;
    }

    @Override
    public void onBackPressed() {
        mWasBackPressed=true;
        super.onBackPressed();
    }

    public void setTitleByTag(String tag){

    }

    @Override
    protected void onRestoreInstanceState(Bundle savedInstanceState) {
        super.onRestoreInstanceState(savedInstanceState);
        final FragmentManager fm = getSupportFragmentManager();
        if (fm != null)
        {
            final int count = fm.getBackStackEntryCount();
            if (count > 0)
            {
                mCurrentVisibleFragment = fm.getBackStackEntryAt(count - 1).getName();
                if (fm.getBackStackEntryCount() > 1)
                    mPrevVisibleFragment = fm.getBackStackEntryAt(count - 2).getName();
                else
                    mPrevVisibleFragment = mCurrentVisibleFragment;
            }
        }
    }
}