from RPLCD.i2c import CharLCD

lcd = CharLCD(i2c_expander='PCF8574', address=0x27, port=1, cols=16, rows=2, dotsize=8)
lcd.clear()

def display(jumlah, harga):
    jumlah_text = jumlah
    harga_text= harga

    lcd.write_string("Jumlah: {} \r\n Harga : {}".format(jumlah_text, harga_text))
    # lcd.write_string(harga_text)
    # lcd.lf()
    #lcd.write_string(harga_text)

lcd.close()
