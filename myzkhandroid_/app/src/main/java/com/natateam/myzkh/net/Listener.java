package com.natateam.myzkh.net;


public abstract class Listener {
	public abstract void onResponse(BaseRequest request);
	public abstract void onError(Error error, BaseRequest request);
}
