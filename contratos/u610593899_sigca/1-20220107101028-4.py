print("\nPrograma que calcula el valor a pagar....! \n\n")

print("Digite el valor unitario del producto: ", end='')
valor = int(input())
print("Digite la cantidad a comprar: ", end='')
cantidad = int(input())

if cantidad > 20:
    total = (valor * cantidad) - ((valor * cantidad) *0.2) 
elif cantidad > 10:
#elif cantidad > 10 and cantidad <= 20:
     total = (valor * cantidad)  - ((valor * cantidad) * 0.05) 
else:
    total = (valor * cantidad)

print("El valor a Pagar es: ",total)