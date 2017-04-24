@inject('Inputs','App\Lib\InputTemplates')

<p>test</p>
{!!$Inputs::test()!!}
<p>{{$test}}</p>
<p>{{$request}}</p>