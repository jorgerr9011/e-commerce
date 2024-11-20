<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /*
    Para resumir: Vincula al modelo con la base de datos creada en las 
    migraciones

    En caso de que la convención no sea la correcta (tabla -> products y 
    modelo en singular Product con letra mayúscula), será necesario 
    cambiar el parámetro por defecto del siguiente atributo:
        protected $table = 'products';

    $fillable -> Nos va a servir para indicar que campos del objeto
    van a poder ser cumplimentables.
    
    $guarded -> Al contrario de fillable, guarded son los campos que estamos
    guardando (si defino los guard, ya no hace falta definir fillable, y 
    viceversa).

    $casts -> Creo que de alguna manera son como restricciones o triggers, 
    en donde se puede especificar, por ejemplo, el tipo de un dato.

    protected $casts = [
        "fechaProducto" -> "date"
    ]

    $hidden -> Sirve para que no se entreguen datos que no deben ser 
    entregados cuando serializamos contenido. Por ejemplo, cuando hacemos
    una API y devolvemos elementos, por ejemplo si guardamos usuarios, 
    no se debería entregar el password de los usuarios, ya que debería 
    ser privado.

    */

    protected $fillable = [
        'name',
        'details',
        'price',
        'discounts'
    ];
}
