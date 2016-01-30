package com.natateam.myzkh.model;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;

/**
 * Медиатор для контекста, возможность запускать активити из сервиса
 * 
 * @author alexander
 * 
 */
public class ContextMediator {
	// Переменная класса
	private final Context mContext;

	/**
	 * Конструктор
	 * 
	 * @param context
	 */
	public ContextMediator(Context context) {
		mContext = context;
	}

	/**
	 * Получение контекста
	 * @return
	 */
	protected Context getContext() {
		return mContext;
	}

	/**
	 * Запуск activity
	 * @param cls
	 */
	protected void startActivity(Class<?> cls) {
		Intent intent = new Intent(mContext, cls);
		mContext.startActivity(intent);
	}

	/**
	 * Запуск activity
	 * @param cls
	 * @param extras
	 */
	protected void startActivity(Class<?> cls, Bundle extras) {
		Intent intent = new Intent(mContext, cls);
		intent.replaceExtras(extras);

		mContext.startActivity(intent);
	}

}
