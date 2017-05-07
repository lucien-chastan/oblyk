@component('mail::message')

# Signalement de problème

## Information sur le problème

**Model :** {{$data['model']}}  
**Model Id :** {{$data['id']}}  
**Page :** [{{$data['page']}}]({{$data['page']}})  

**Description :**  
{{$data['problem']}}

## Information sur le grimpeur

**email :** [{{$data['email']}}](mailto:{{$data['email']}})  
**user id :** {{$data['user_id']}}


@endcomponent