package org.Hak5.WifiScanner;

import java.util.List;

import android.app.Activity;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.net.wifi.ScanResult;
import android.net.wifi.WifiManager;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;

public class WiFiScanner extends Activity {
	
    TextView textView;
    WifiManager wifi;
	BroadcastReceiver receiver;

	@Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        
        setContentView(R.layout.main);
        
        textView = (TextView) this.findViewById(R.id.wifitext);
        
        wifi = (WifiManager) this.getSystemService(WIFI_SERVICE);
        
        if (receiver == null)
			receiver = new WiFiScanReceiver(this);

		registerReceiver(receiver, new IntentFilter(WifiManager.SCAN_RESULTS_AVAILABLE_ACTION));
		
        populate();
	 
    }
	
	private void populate() {
		String text = "";
		List<ScanResult> access_points = wifi.getScanResults();
		for(int i = 0 ; i < access_points.size() ; i++){
			ScanResult ap = access_points.get(i);
			text += "#SSID: " + ap.SSID + "/Security: " + ap.capabilities + "/Frequency: " + ap.frequency + "/DB: " + ap.level +"\n\n";
		}
		textView.setText(text);
		Log.d("Wifi Display", text);
		wifi.startScan();
	}
    
	
	class WiFiScanReceiver extends BroadcastReceiver {
		
		WiFiScanner wifiScanner;
		
		public WiFiScanReceiver(WiFiScanner wifiDemo) {
		super();
		this.wifiScanner = wifiDemo;
		}
		
		@Override
		public void onReceive(Context c, Intent intent) {
			wifiScanner.populate();
		}
	}
	
}