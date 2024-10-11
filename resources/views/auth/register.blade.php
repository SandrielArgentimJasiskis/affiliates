<x-guest-layout>
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid gap-6">
                <!-- Name -->
                <div class="space-y-2">
                    <x-form.label
                        for="name"
                        :value="__('Name')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="name"
                            class="block w-full"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            placeholder="{{ __('Name') }}"
							maxlength="255"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-form.label
                        for="email"
                        :value="__('Email')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="email"
                            class="block w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            placeholder="{{ __('Email') }}"
							maxlength="255"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Phone -->
                <div class="space-y-2" x-data="{
					phone: '{{ old('phone') }}',
					formatPhone() {
						let value = this.phone.replace(/\D/g, '');
						if (value.length > 10) {
							// Formato com 9 dígitos (99) 99999-9999
							value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
						} else if (value.length > 6) {
							// Formato com 8 dígitos (99) 9999-9999
							value = value.replace(/^(\d{2})(\d{4})(\d{0,4})$/, '($1) $2-$3');
						} else if (value.length > 2) {
							// Parte inicial (99) 9999
							value = value.replace(/^(\d{2})(\d{0,5})$/, '($1) $2');
						} else {
							// Parte inicial (99)
							value = value.replace(/^(\d{0,2})$/, '($1');
						}
						this.phone = value;
					}
				}">
				<x-form.label
					for="phone"
					value="Telefone/Whatsapp"
				/>

				<x-form.input-with-icon-wrapper>
					<x-slot name="icon">
						<x-heroicon-o-phone aria-hidden="true" class="w-5 h-5" />
					</x-slot>

					<x-form.input
						withicon
						id="phone"
						class="block w-full"
						type="text"
						name="phone" 
						:value="old('phone')"
						x-model="phone"
						x-on:input="formatPhone"
						required
						placeholder="Telefone/Whatsapp"
						maxlength="15"
					/>
				</x-form.input-with-icon-wrapper>
			</div>
			<!-- Phone -->
                <!--<div class="space-y-2">
                    <x-form.label
                        for="phone"
                        value="Telefone/Whatsapp"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-phone aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="phone"
                            class="block w-full"
                            type="text"
                            name="phone"
                            :value="old('phone')"
                            
                            placeholder="Telefone/Whatsapp"
                            x-mask="(99) 99999-9999"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>-->


                <!-- Type -->
                <div class="space-y-2">
                    <x-form.label
                        for="type"
                        value="Sua função"
                    />


                    <select id="type" name="type" class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
            focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
            dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 block w-full">
                        <option value="1">Aluno</option>
                        <option value="2">Afiliado</option>
                        <option value="3">Professor</option>
                    </select>
                </div>

                <!-- Document -->
                <div class="space-y-2">
                    <x-form.label
                        for="document"
                        value="CPF"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-identification aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="document"
                            class="block w-full"
                            type="text"
                            name="document"
                            :value="old('document')"
                            required
                            placeholder="CPF"
							x-mask="999.999.999-99"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>


                <!-- Password -->
                <div class="space-y-2">
                    <x-form.label
                        for="password"
                        :value="__('Password')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password"
                            class="block w-full"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="{{ __('Password') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <x-form.label
                        for="password_confirmation"
                        :value="__('Confirm Password')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password_confirmation"
                            class="block w-full"
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="{{ __('Confirm Password') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <div class="space-y-2">
                    <label for="newsletter">
                        <input id="newsletter" name="newsletter" type="checkbox"/> Quero assinar as newsletter
                    <label>
                </div>

				<div x-data="{ modal: false }" class="relative">
                <div class="space-y-2">
                    <label for="terms">
                        <input id="terms" name="terms" type="checkbox" value="1"/> Aceito os 
						<button class="btn btn-primary mb-3 link-to-open-modal" @click.prevent="modal = !modal" :aria-expanded="modal ? 'true' : 'false'">
							termos de uso
						</button>
                    <label>
                </div>
				

				  <!-- Modal -->
				  <div x-show="modal" class="modal-wrapper fixed inset-0 flex items-center justify-center z-50" x-cloak>
					
					<!-- Fundo sombreado (backdrop) -->
					<div class="backdrop fixed inset-0 bg-black bg-black-opacity-50" @click="modal = false"></div>

					<!-- Painel do Modal -->
					<div class="modal-panel modal-panel-div-container bg-white p-5 rounded shadow-lg z-10"
						 @click.away="modal = false"
						 x-show.transition.opacity.duration.500ms="modal">
					  <button class="float-right font-black-force" @click="modal = false">
						  <svg aria-hidden="true" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
						  </svg>
					  </button>
					  <div class="modal-content font-black-force font-black-force-all">
						<div class="container">
							<h1>Termos de Uso</h1>

							<h2>1. Introdução</h2>
							<p>
								Bem-vindo(a) ao nosso site/sistema. Ao acessar e utilizar nossos serviços, você concorda com os seguintes Termos de Uso e com a nossa Política de Privacidade, em conformidade com a Lei Geral de Proteção de Dados Pessoais (LGPD) - Lei nº 13.709/2018.
							</p>

							<h2>2. Coleta e Uso de Dados</h2>
							<p>
								Durante o uso de nossos serviços, podemos solicitar que você forneça algumas informações pessoais, como:
							</p>
							<ul>
								<li>Nome completo;</li>
								<li>Endereço de e-mail;</li>
								<li>Telefone/WhatsApp;</li>
								<li>CPF.</li>
							</ul>
							<p>
								Esses dados são coletados para melhorar sua experiência, fornecer nossos serviços e realizar comunicações necessárias. Utilizamos seus dados pessoais apenas para os fins especificados e respeitamos sua privacidade em conformidade com a LGPD.
							</p>

							<h2>3. Compartilhamento de Dados</h2>
							<p>
								Os dados pessoais dos usuários poderão ser compartilhados com parceiros, fornecedores ou terceiros, somente quando necessário para o fornecimento de serviços relacionados. Garantimos que essas partes adotem medidas adequadas para proteger os dados compartilhados, seguindo as regulamentações da LGPD.
							</p>

							<h2>4. Direitos dos Usuários</h2>
							<p>
								De acordo com a LGPD, você tem os seguintes direitos em relação aos seus dados pessoais:
							</p>
							<ul>
								<li><strong>Confirmação e acesso</strong>: Você pode solicitar confirmação sobre o processamento dos seus dados e obter uma cópia deles.</li>
								<li><strong>Correção</strong>: Se algum dado estiver incorreto, você pode solicitar a correção.</li>
								<li><strong>Anonimização, bloqueio ou exclusão</strong>: Você pode solicitar a anonimização, bloqueio ou eliminação de dados desnecessários.</li>
								<li><strong>Portabilidade</strong>: Direito de solicitar a transferência de seus dados a outro fornecedor de serviços.</li>
								<li><strong>Revogação de consentimento</strong>: Você pode retirar seu consentimento para o processamento de dados a qualquer momento.</li>
							</ul>

							<h2>5. Segurança de Dados</h2>
							<p>
								Empregamos medidas técnicas e organizacionais adequadas para garantir a segurança dos seus dados pessoais, protegendo-os contra acessos não autorizados, perdas, destruição ou alterações.
							</p>

							<h2>6. Cookies e Tecnologias de Rastreamento</h2>
							<p>
								Utilizamos cookies para melhorar a experiência do usuário em nosso site/sistema. Os cookies são pequenos arquivos armazenados no seu navegador que coletam informações sobre sua navegação. Você pode ajustar as configurações do seu navegador para recusar cookies, mas isso pode afetar o funcionamento de algumas partes do site.
							</p>

							<h2>7. Alterações nos Termos de Uso</h2>
							<p>
								Podemos modificar ou atualizar estes Termos de Uso periodicamente para garantir conformidade com novas leis ou regulamentações. Notificaremos os usuários sobre quaisquer mudanças substanciais. Recomendamos que você reveja regularmente estes Termos de Uso.
							</p>

							<h2>8. Contato</h2>
							<p>
								Se você tiver dúvidas ou preocupações sobre o uso dos seus dados pessoais, ou se quiser exercer seus direitos sob a LGPD, entre em contato conosco pelo e-mail [email de contato] ou pelo telefone [telefone de contato].
							</p>
						</div>
					  </div>
					</div>
				  </div>
				</div>


                <div>
                    <x-button class="justify-center w-full gap-2">
                        <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                        <span>{{ __('Register') }}</span>
                    </x-button>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Already registered?') }}
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                        {{ __('Login') }}
                    </a>
                </p>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
