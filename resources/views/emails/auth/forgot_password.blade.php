@component('mail::message')
# Ola {{ $name }}
Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.
@component('mail::button', ['url' => $url])
Clique aqui para redefinir sua senha
@endcomponent

Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.

{{ config('app.name') }} Agradecemos por usar nosso serviço.

@endcomponent
