import requests
import json
import Counter
import time
import cProfile

while(True):
    try:
        print("getting status..")
        x = requests.get('https://fishcounterta.000webhostapp.com/status.php')
        response_json = x.json()

        # Mengekstrak nilai dari JSON
        # id_value = response_json['id']
        hitung_status = response_json['hitung']

        if hitung_status == 'true':
            jumlah_value = int(response_json['jumlah'])
            harga_value = int(response_json['harga'])


            # buka servo

            # call hitung
            # Counter.count(jumlah_value)

            # tutup servo dan bunyi buzzer

            # tampilkan data di lcd
            print(jumlah_value*harga_value)

            # reset table status
            x = requests.post('https://fishcounterta.000webhostapp.com/status.php') 
            print(x.json())
    except KeyboardInterrupt:
        break
    except Exception as e:
        print(e.args)
    finally:
        time.sleep(2)

