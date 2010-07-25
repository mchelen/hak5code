package org.Hak5.WifiScanner;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;
import java.util.SortedMap;
import java.util.TreeMap;

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
	// scanHistory stores an array of scanresult sortedmaps
	ArrayList<SortedMap<String,ScanResult>> scanHistory = new ArrayList<SortedMap<String,ScanResult>>();
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
		// get current wifi scan results
		List<ScanResult> access_points = wifi.getScanResults();
		// create sorted map of scanresults with SSID keys, ignore case
		SortedMap<String,ScanResult> map = new TreeMap<String,ScanResult>(String.CASE_INSENSITIVE_ORDER);		
		// loop through scan results and add to map
		for(int i = 0 ; i < access_points.size() ; i++){
		    // get current ScanResult
		    ScanResult ap = access_points.get(i);
		    // add to the map
			map.put(ap.SSID,ap);
		}
		// blank text string
        String text = "";
        // loop through map
		for (Map.Entry<String,ScanResult> entry : map.entrySet()) {
		    // load scanresult from map
		    ScanResult ap = entry.getValue();
		    // build output string
            text += "#SSID: " + ap.SSID
            + "/Security: " + ap.capabilities
            + "/Frequency: " + ap.frequency;
            // current DB level
            text += "\nDB: " + ap.level;
            // number of db history to show besides current reading
            int maxHistory=7;
            // output old scan result db levels
            for (int i=0;i<maxHistory;i++) {
                if (scanHistory.size() > i) {
                    // load newest item from scan history
                    SortedMap<String,ScanResult> oldMap = scanHistory.get(scanHistory.size()-1-i);
                    // check if old scanresult exists for ssid 
                    if (oldMap.get(ap.SSID) != null) {
                        // output old db level
                        ScanResult oldAp = oldMap.get(ap.SSID);
                        text += ", " + oldAp.level;
                    }
                }
            }
            // blank line between networks
            text += "\n\n";
        }
		// display text
		textView.setText(text);
		// output to log
		Log.d("Wifi Display", text);
		// add current scan map to end of history list
        scanHistory.add(map);
        if (scanHistory.size() > 10) {
            // remove oldest scan history item
            scanHistory.remove(0);
        }
        // start scan again        
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