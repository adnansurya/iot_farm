import urllib.request as req
import urllib.parse as par
apiurl = 'https://makassarrobotics.000webhostapp.com/iot_farm/api/add_data.php'
data = {
        'suhu_udara' : 1,
        'lembab_udara' : 2,
        'lembab_tanah' :3,
        'ph_tanah' : 4
    }
data = bytes(par.urlencode(data).encode())
handler = req.urlopen(apiurl,data)
print(handler.read().decode('utf-8'))