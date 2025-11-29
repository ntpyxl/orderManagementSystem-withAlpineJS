function cartComponent() {
    return {
		cart: [],

        addToCart(item) {
			item = {
				itemId: item.item_id,
				itemName: item.item_name,
				itemPrice: item.price,
				itemQuantity: item.quantity
			}

			if (!item.itemQuantity || item.itemQuantity <= 0) {
					return;
				}

			const existingItem = this.cart.find(
				(cartItem) => cartItem.itemName === item.itemName
			);

			if (existingItem) {
				existingItem.itemQuantity += item.itemQuantity;
			} else {
				this.cart.push(item);
				console.log("Cart updated:", this.cart);
			}
        },

		get totalAmount() {
			return this.cart.reduce((sum, item) => sum + item.itemPrice * item.itemQuantity, 0);
		},

		clearCart() {
			this.cart = [];
			this.userPayAmount = null;
		},

		async checkOutCart(userPayAmount) {
			if (!userPayAmount || userPayAmount <= 0) {
				return;
			}

			const totalAmount = this.cart.reduce((sum, item) => sum + item.itemPrice * item.itemQuantity, 0);

			if (userPayAmount >= totalAmount) {
				try {
					await apiRequest("checkOutCart", this.cart, "transactionManager");

					Swal.fire({
						title: "Thank you for purchasing from Pixelshop!",
						text: `Your change is PHP ${userPayAmount - totalAmount}`,
						icon: "success",
						confirmButtonColor: "#14b8a6",
					}).then(() => {
						this.clearCart();
					});
				} catch (error) {
					alertError(error);
				}
			} else {
				Swal.fire({
					title: "You have insufficient funds!",
					text: `You are missing PHP ${totalAmount - userPayAmount}!`,
					icon: "error",
					confirmButtonColor: "#ef4444",
				});
			}
		}
    };
}