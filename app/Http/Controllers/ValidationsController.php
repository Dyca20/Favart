<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;


class ValidationsController extends Controller
{

    protected function reglas_registro()
    {
        $reglas = [
            'nombre_Usuario' => ['required', 'string', 'min:5', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'required_with:password_confirmation', 'same:password_confirmation'],
            'password_confirmation' => ['min:8'],
            'name' => ['required', 'string', 'min:2', 'max:25'],
            'apellidos' => ['required', 'string', 'min:5', 'max:25'],
            'direccion' => ['required', 'string', 'min:10', 'max:255'],
            'email' => ['required', 'email', 'min:5', 'max:255', 'unique:users'],
            'edad' => ['required', 'numeric', 'max:100'],
            'telefono' => 'required | numeric| min:8', 'unique:users',
        ];
        return $reglas;
    }

    protected function mensajes_registro()
    {

        $mensaje = [
            'nombre_Usuario.required' => 'El nombre de usuario es requerido',
            'nombre_Usuario.min' => 'El nombre de usuario debe ser de al menos 5 carácteres',
            'nombre_Usuario.max' => 'El nombre de usuario debe máximo de 25 carácteres',
            'nombre_Usuario.unique' => 'Ya existe una cuenta asociada a ese nombre de usuario',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe ser al menos de 8 carácteres',
            'password.required_with' => 'La contraseña debe ser confirmada',
            'password.same' => 'Las contraseñas no coinciden',
            'password_confirmation.min' => 'La confirmación no cumple el mínimo de 8 carácteres',
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe ser al menos de 2 carácteres',
            'name.max' => 'El nombre es demasiado largo, utiliza un nombre más corto',
            'apellidos.required' => 'Los apellidos son requeridos',
            'apellidos.min' => 'Los apellidos deben ser al menos de 5 carácteres',
            'apellidos.max' => 'Los apellidos deben ser máximo de 25 carácteres',
            'direccion.required' => 'La dirección es requerida',
            'direccion.min' => 'La dirección es muy corta',
            'direccion.max' => 'La dirección es muy larga',
            'email.required' => 'El correo electrónico es requerido',
            'email.min' => 'El correo electrónico debe contener al menos 5 carácteres',
            'email.max' => 'El correo electrónico es demasiado largo',
            'email.unique' => 'Ya existe una cuenta asociada a ese correo electrónico',
            'email.email' => 'El correo electrónico debe contener la forma ejemplo@ejemplo.com',
            'edad.max' => 'La edad es muy alta.',
            'edad.required' => 'La edad es requerida',
            'edad.min' => 'La edad es muy pequeña',
            'edad.numeric' => 'La edad debe ser un número entero',
            'telefono.required' => 'El número de teléfono es requerido',
            'telefono.min' => 'Los números de teléfono deben ser de 8 dígitos',
            'telefono.max' => 'Los números de teléfono deben ser de 8 dígitos',
            'telefono.numeric' => 'Este campo solo admite números',
            'telefono.unique' => 'Ya existe una cuenta asociada a ese telefono',

        ];

        return $mensaje;
    }

    protected function reglas_registroEditar($contraseña)
    {

        $reglas = '';
        if ($contraseña != null) :
            $reglas = [
                'nombre_Usuario' => ['required', 'string', 'min:5', 'max:25'],
                'password' => ['required', 'string', 'min:8', 'required_with:password_confirmation', 'same:password_confirmation'],
                'password_confirmation' => ['min:8'],
                'name' => ['required', 'string', 'min:2', 'max:25'],
                'apellidos' => ['required', 'string', 'min:5', 'max:25'],
                'email' => ['required', 'email', 'min:5', 'max:255'],
                'edad' => ['required', 'numeric', 'max:100'],
                'telefono' => 'required | numeric| min:8 ',
            ];
        else :
            $reglas = [
                'nombre_Usuario' => ['required', 'string', 'min:5', 'max:25'],
                'name' => ['required', 'string', 'min:2', 'max:25'],
                'apellidos' => ['required', 'string', 'min:5', 'max:25'],
                'email' => ['required', 'email', 'min:5', 'max:255'],
                'edad' => ['required', 'numeric', 'max:100'],
                'telefono' => 'required | numeric| min:8 ',
            ];
        endif;
        return $reglas;
    }

    protected function mensajes_registroeditar($contraseña)
    {

        $mensaje = '';
        if ($contraseña != null) :
            $mensaje = [
                'nombre_Usuario.required' => 'El nombre de usuario es requerido',
                'nombre_Usuario.min' => 'El nombre de usuario debe ser de al menos 5 carácteres',
                'nombre_Usuario.max' => 'El nombre de usuario debe máximo de 25 carácteres',
                'password.required' => 'La contraseña es requerida',
                'password.min' => 'La contraseña debe ser al menos de 8 carácteres',
                'password.required_with' => 'La contraseña debe ser confirmada',
                'password.same' => 'Las contraseñas no coinciden',
                'password_confirmation.min' => 'La confirmación no cumple el mínimo de 8 carácteres',
                'name.required' => 'El nombre es requerido',
                'name.min' => 'El nombre debe ser al menos de 2 carácteres',
                'name.max' => 'El nombre es demasiado largo, utiliza un nombre más corto',
                'apellidos.required' => 'Los apellidos son requeridos',
                'apellidos.min' => 'Los apellidos deben ser al menos de 5 carácteres',
                'apellidos.max' => 'Los apellidos deben ser máximo de 25 carácteres',
                'email.required' => 'El correo electrónico es requerido',
                'email.min' => 'El correo electrónico debe contener al menos 5 carácteres',
                'email.max' => 'El correo electrónico es demasiado largo',
                'email.unique' => 'Ya existe una cuenta asociada a ese correo electrónico',
                'email.email' => 'El correo electrónico debe contener la forma ejemplo@ejemplo.com',
                'edad.max' => 'La edad es muy alta.',
                'edad.required' => 'La edad es requerida',
                'edad.min' => 'La edad es muy pequeña',
                'edad.numeric' => 'La edad debe ser un número entero',
                'telefono.required' => 'El número de teléfono es requerido',
                'telefono.min' => 'Los números de teléfono deben ser de 8 dígitos',
                'telefono.max' => 'Los números de teléfono deben ser de 8 dígitos',
                'telefono.numeric' => 'Este campo solo admite números',

            ];
        else :
            $mensaje = [
                'nombre_Usuario.required' => 'El nombre de usuario es requerido',
                'nombre_Usuario.min' => 'El nombre de usuario debe ser de al menos 5 carácteres',
                'nombre_Usuario.max' => 'El nombre de usuario debe máximo de 25 carácteres',
                'name.required' => 'El nombre es requerido',
                'name.min' => 'El nombre debe ser al menos de 2 carácteres',
                'name.max' => 'El nombre es demasiado largo, utiliza un nombre más corto',
                'apellidos.required' => 'Los apellidos son requeridos',
                'apellidos.min' => 'Los apellidos deben ser al menos de 5 carácteres',
                'apellidos.max' => 'Los apellidos deben ser máximo de 25 carácteres',
                'email.required' => 'El correo electrónico es requerido',
                'email.min' => 'El correo electrónico debe contener al menos 5 carácteres',
                'email.max' => 'El correo electrónico es demasiado largo',
                'email.unique' => 'Ya existe una cuenta asociada a ese correo electrónico',
                'email.email' => 'El correo electrónico debe contener la forma ejemplo@ejemplo.com',
                'edad.max' => 'La edad es muy alta.',
                'edad.required' => 'La edad es requerida',
                'edad.min' => 'La edad es muy pequeña',
                'edad.numeric' => 'La edad debe ser un número entero',
                'telefono.required' => 'El número de teléfono es requerido',
                'telefono.min' => 'Los números de teléfono deben ser de 8 dígitos',
                'telefono.max' => 'Los números de teléfono deben ser de 8 dígitos',
                'telefono.numeric' => 'Este campo solo admite números',
            ];
        endif;
        return $mensaje;
    }

    protected function reglas_ProductoEditar()
    {

        $reglas = '';
        $reglas = [
            'nombre_Producto' => ['required', 'string', 'min:4', 'max:25'],
            'categoria' => ['required', 'string', 'min:2', 'max:25'],
            'precio' => ['required', 'numeric', 'max:100000'],
            'cantidad' => ['required', 'numeric', 'max:1000'],
            'detalles' => ['required', 'string', 'min:5', 'max:255'],

        ];

        return $reglas;
    }

    protected function mensajes_ProductoEditar()
    {

        $mensaje = '';

        $mensaje = [
            'nombre_Producto.required' => 'El nombre del producto es requerido',
            'nombre_Producto.min' => 'El nombre del producto  debe ser de al menos 5 carácteres',
            'nombre_Producto.max' => 'El nombre del producto  debe máximo de 25 carácteres',
            'categoria.required' => 'La categoria es requerido',
            'categoria.min' => 'La categoria debe ser al menos de 2 carácteres',
            'categoria.max' => 'La categoria es demasiado largo, utiliza un nombre más corto',
            'cantidad.max' => 'La cantidad máxima esta predefinida en 1000',
            'cantidad.required' => 'La cantidad es requerida',
            'cantidad.min' => 'La cantidad no puede ser 0',
            'cantidad.numeric' => 'La cantidad debe ser un número entero',
            'precio.required' => 'El precio es requerido',
            'precio.min' => 'El precio no puede ser 0',
            'precio.max' => 'El precio máximo esta predefinido en ₡100 000',
            'precio.numeric' => 'Este campo solo admite números',

        ];

        return $mensaje;
    }
    
    protected function reglas_addproduct()
    {

        $reglas = '';
        $reglas = [
            'nombre_Producto' => ['required', 'string', 'min:4', 'max:25'],
            'categoria' => ['required', 'string', 'min:2', 'max:25'],
            'precio' => ['required', 'numeric', 'max:100000'],
            'cantidad' => ['required', 'numeric', 'max:1000'],
            'detalles' => ['required', 'string', 'min:5', 'max:255'],
            'imagen' => ['required'],

        ];

        return $reglas;
    }

    protected function mensajes_addproduct()
    {

        $mensaje = '';

        $mensaje = [
            'nombre_Producto.required' => 'El nombre del producto es requerido',
            'nombre_Producto.min' => 'El nombre del producto  debe ser de al menos 5 carácteres',
            'nombre_Producto.max' => 'El nombre del producto  debe máximo de 25 carácteres',
            'categoria.required' => 'La categoria es requerido',
            'categoria.min' => 'La categoria debe ser al menos de 2 carácteres',
            'categoria.max' => 'La categoria es demasiado largo, utiliza un nombre más corto',
            'cantidad.max' => 'La cantidad máxima esta predefinida en 1000',
            'cantidad.required' => 'La cantidad es requerida',
            'cantidad.min' => 'La cantidad no puede ser 0',
            'cantidad.numeric' => 'La cantidad debe ser un número entero',
            'precio.required' => 'El precio es requerido',
            'precio.min' => 'El precio no puede ser 0',
            'precio.max' => 'El precio máximo esta predefinido en ₡100 000',
            'precio.numeric' => 'Este campo solo admite números',
            'imagen.required' => 'Es necesario colocar una imagen',
        ];

        return $mensaje;
    }
}