from flask import Flask, render_template, request, redirect, url_for
import uuid
import datetime
from exchange_rates import exchange_rates

app = Flask(__name__)

# Función para calcular el monto convertido y la comisión
def calculate_conversion(amount_clp, currency):
    if currency not in exchange_rates:
        raise ValueError("Moneda no soportada")
    
    converted_amount = amount_clp * exchange_rates[currency]
    commission = converted_amount * 0.001
    final_amount = converted_amount - commission
    
    return converted_amount, commission, final_amount

# Ruta principal
@app.route('/')
def index():
    return render_template('index.html')

# Ruta para procesar la solicitud
@app.route('/process', methods=['POST'])
def process():
    sender = request.form['sender']
    receiver = request.form['receiver']
    amount_clp = float(request.form['amount_clp'])
    currency = request.form['currency']
    
    try:
        converted_amount, commission, final_amount = calculate_conversion(amount_clp, currency)
        receipt_id = str(uuid.uuid4())
        date = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        
        receipt = {
            'receipt_id': receipt_id,
            'date': date,
            'sender': sender,
            'receiver': receiver,
            'amount_clp': amount_clp,
            'currency': currency,
            'converted_amount': converted_amount,
            'commission': commission,
            'final_amount': final_amount
        }
        
        # Aquí se podría almacenar el comprobante en una base de datos
        return render_template('result.html', receipt=receipt)
    except ValueError as e:
        return str(e)

if __name__ == '__main__':
    app.run(debug=True)
