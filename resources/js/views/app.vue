<template>
	<div>
		<div class="container mx-auto px-4">
			<form action="" method="POST" @submit.prevent="register" id="submission-form">
				<div class="mt-8 max-w-lg">
					<div class="grid grid-cols-1 gap-8">
						<label class="block">
							<span class="text-gray-800 required">Name</span>
							<input type="text" v-model="form.name"
								class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
								placeholder="" name="name">
							<has-error :form="form" field="name" class="error"></has-error>
						</label>
						<label class="block">
							<span class="text-gray-700 required">Email</span>
							<input type="email" v-model="form.email"
								class="required mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
								placeholder="john@example.com" name="email">
							<has-error :form="form" field="email" class="error"></has-error>
						</label>
						<label class="block">
							<span class="text-gray-700 required">Phone</span>
							<input type="tel" v-model="form.phone"
								class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
								placeholder="" name="phone">
							<has-error :form="form" field="phone" class="error"></has-error>
						</label>
						<label class="block">
							<span class="text-gray-700 required">Message</span>
							<textarea name="message" v-model="form.message"
								class="mt-1 block w-full bg-gray-100 rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:border-gray-500 focus:bg-white focus:ring-0"></textarea>
							<has-error :form="form" field="message" class="error"></has-error>
						</label>
						<label class="block">
							<span class="text-gray-700 required">Start Date</span>
							<input type="text" v-model="form.start_date"
								class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
								placeholder="" name="start_date">
							<has-error :form="form" field="start_date" class="error"></has-error>
						</label>
						<label class="block">
							<span class="text-gray-700 required">End Date</span>
							<input type="text" v-model="form.end_date"
								class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
								placeholder="" name="end_date">
							<has-error :form="form" field="end_date" class="error"></has-error>
						</label>
						<label class="block">
							<input type="checkbox" v-model="form.need_on_site_service" placeholder=""
								name="need_on_site_service" v-on:change="checkboxToggle()">
							<span class="text-gray-700">Need on site service</span>
							<has-error :form="form" field="need_on_site_service" class="error"></has-error>
						</label>
						<label class="block address" v-bind:class="{ invisible: isAddressInvisible }">
							<span class="text-gray-700 required">Address</span>
							<textarea type="text" v-model="form.address"
								class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
								placeholder="" name="address"></textarea>
							<has-error :form="form" field="address" class="error"></has-error>
						</label>
						<div class="px-4 py-3 text-right sm:px-6">
							<button type="submit"
								class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
								Save
							</button>
						</div>
						<div class="px-3 py-3 mb-3 bg-blue-100" v-bind:class="{ invisible: isInvisible }"
							id="response-message">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
import axios from 'axios';

export default {

	data() {
		return {
			form: new Form({
				name: '',
				email: '',
				phone: '',
				message: '',
				start_date: '',
				end_date: '',
				need_on_site_service: '',
				address: '',
			}),
			isInvisible: true,
			isAddressInvisible: true,
		};
	},

	methods: {

		register() {
			this.form.post('/contact')
				.then((response) => {
					var attr = document.getElementById('response-message');
					this.isInvisible = false;
					attr.innerHTML = response.data.message;
					this.form.reset();
				});

		},

		checkboxToggle() {
			if (this.isAddressInvisible === true) {
				this.isAddressInvisible = false;
			} else {
				this.isAddressInvisible = true;
			}
		}
	},
};
</script>