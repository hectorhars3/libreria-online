import uuid
import datetime

# Tasas de cambio (ejemplo)
exchange_rates = {
    'USD': 0.0013,
    'VEF': 0.000004,
    'EUR': 0.0011
}

# Función para calcular el monto convertido y la comisión
def calculate_conversion(amount_clp, currency):
    if currency not in exchange_rates:
        raise ValueError("Moneda no soportada")
    
    converted_amount = amount_clp * exchange_rates[currency]
    commission = converted_amount * 0.001
    final_amount = converted_amount - commission
    
    return converted_amount, commission, final_amount

# Función para generar el comprobante
def generate_receipt(sender, receiver, amount_clp, currency, converted_amount, commission, final_amount):
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
    
    # Aquí se podría almacenar el comprobante en una base de datos o archivo
    # Por simplicidad, lo imprimimos en pantalla
    print("Comprobante generado:")
    for key, value in receipt.items():
        print(f"{key}: {value}")
    
    return receipt

# Función principal para procesar la solicitud
def process_request(sender, receiver, amount_clp, currency):
    try:
        converted_amount, commission, final_amount = calculate_conversion(amount_clp, currency)
        receipt = generate_receipt(sender, receiver, amount_clp, currency, converted_amount, commission, final_amount)
        return receipt
    except ValueError as e:
        print(f"Error: {e}")
        return None

# Ejemplo de uso
sender = "Juan Pérez"
receiver = "María López"
amount_clp = 100000  # Monto en pesos chilenos
currency = 'USD'  # Moneda destino

receipt = process_request(sender, receiver, amount_clp, currency)