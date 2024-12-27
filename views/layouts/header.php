<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="/" class="d-lg-none">
                <img alt="Logo" src="assets/media/logos/fav.black.svg" class="h-30px" />
            </a>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                        <span class="menu-link">
                            <a href="/" id="header-dashboard" class="menu-title">Dashboard</a>
                        </span>
                    </div>
                    
                </div>
            </div>
                <div class="app-navbar flex-shrink-0">
                    <div class="app-navbar-item ms-1 ms-md-4">
                        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-wallet fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </div>
                        <div id="wallet-popup" class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-350px" data-kt-menu="true">
                            <div class="card">
                            <div class="card-header">
                                <div id="walet-title" class="card-title">Your Balance</div>
                                <div class="card-toolbar">
                                    <span id="balance" class="text-hover-primary fw-bold me-n3">
                                        8555<i class="bi bi-currency-euro"></i>
                                    </span>
                                </div>
                            </div>
                            <script>
                            getRequest(
                                `website/wallet/${getUserId()}`,
                                function (response) {
                                    if (response.status !== 200) {
                                        return;
                                    }
                                    const walletData = response.data.data[0];
                                    const balanceElement = document.getElementById('balance');
                                    if (balanceElement) {
                                        balanceElement.innerHTML = `${walletData.credit} <i class="bi bi-currency-euro"></i>`;
                                    }
                                    const walletTitleElement = document.getElementById('walet-title');
                                    if (walletTitleElement) {
                                        walletTitleElement.textContent = walletData.title;
                                    }
                                    const element = document.getElementById('walet-0');
                                    if (element) {
                                        element.innerHTML = `${walletData.credit}
                                            <span class="text-muted fs-4 fw-semibold bi-currency-euro"></span>
                                            <div class="fs-7 fw-normal text-muted">
                                                Balance will increase the amount due on the customer's next invoice.
                                            </div>
                                        `;
                                    }
                                },
                                function (error) {
                                    redirectToLoginIfUnauthorized(error);
                                }
                            );
                        </script>

                                <div class="card-body py-5">
                                    <div class="wallet-balance mh-350px me-n5 pe-5">
                                        <div class="card-toolbar">
                                            <a href="/my-transaction" class="btn btn-sm btn-flex btn-light-primary">
                                                <i class="ki-duotone ki-abstract-10 fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>Recharge
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="app-navbar-item ms-1 ms-md-4">
                    <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-basket fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-350px" data-kt-menu="true">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">My Cards</div>
                                <div class="card-toolbar">
                                    <span id="price_cards" class="text-hover-primary fw-bold me-n3" >
                                            </span>
                                </div>
                            </div>
                            <div class="card-body py-5">
                                <div id="Carts"  class="mh-350px scroll-y me-n5 pe-3">
                                    <span class="fs-3 text-danger d-flex justify-content-center fw-bold mb-7"  >cart is empty</span>
                                </div>
                                <div  class="d-flex mh-50px border-top align-content-center justify-content-center" >
                                    <div class="card-toolbar mt-4 " data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-original-title="Click to checkout" data-kt-initialized="1">
                                        <a id="btn_Cards" href="/check-out" class="btn btn-sm btn-light btn-active-primary">
                                            <i class="ki-duotone ki-plus fs-2"></i>checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-navbar-item ms-1 ms-md-4">
                    <a href="#" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-night-day theme-light-show fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                            <span class="path7"></span>
                            <span class="path8"></span>
                            <span class="path9"></span>
                            <span class="path10"></span>
                        </i>
                        <i class="ki-duotone ki-moon theme-dark-show fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-night-day fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
														<span class="path5"></span>
														<span class="path6"></span>
														<span class="path7"></span>
														<span class="path8"></span>
														<span class="path9"></span>
														<span class="path10"></span>
													</i>
												</span>
                                <span class="menu-title">Light</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-moon fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
                                <span class="menu-title">Dark</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-screen fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
													</i>
												</span>
                                <span class="menu-title">System</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img src="assets/media/avatars/blank.png" class="rounded-3" alt="user" />
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="assets/media/avatars/blank.png" />
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5"><b id="profile-username">ArmanMsv</b>
                                        <span id="profile-email-verified" class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2"></span></div>
                                    <a id="profile-email" href="#" class="fw-semibold text-muted text-hover-primary fs-7">a.mousavi@baduno@com</a>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a href="/profile" class="menu-link px-5">My Profile</a>
                        </div>

                        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                            <a href="#" class="menu-link px-5">
												<span class="menu-title position-relative">Mode
												<span class="ms-5 position-absolute translate-middle-y top-50 end-0">
													<i class="ki-duotone ki-night-day theme-light-show fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
														<span class="path5"></span>
														<span class="path6"></span>
														<span class="path7"></span>
														<span class="path8"></span>
														<span class="path9"></span>
														<span class="path10"></span>
													</i>
													<i class="ki-duotone ki-moon theme-dark-show fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span></span>
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
														<span class="menu-icon" data-kt-element="icon">
															<i class="ki-duotone ki-night-day fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
																<span class="path4"></span>
																<span class="path5"></span>
																<span class="path6"></span>
																<span class="path7"></span>
																<span class="path8"></span>
																<span class="path9"></span>
																<span class="path10"></span>
															</i>
														</span>
                                        <span class="menu-title">Light</span>
                                    </a>
                                </div>
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
														<span class="menu-icon" data-kt-element="icon">
															<i class="ki-duotone ki-moon fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</span>
                                        <span class="menu-title">Dark</span>
                                    </a>
                                </div>
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
														<span class="menu-icon" data-kt-element="icon">
															<i class="ki-duotone ki-screen fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
																<span class="path4"></span>
															</i>
														</span>
                                        <span class="menu-title">System</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                            <a href="#" class="menu-link px-5">
												<span class="menu-title position-relative">Language
												<span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
												<img class="w-15px h-15px rounded-1 ms-2" src="assets/media/flags/united-states.svg" alt="" /></span></span>
                            </a>
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5 active">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="assets/media/flags/united-states.svg" alt="" />
													</span>English</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="assets/media/flags/spain.svg" alt="" />
													</span>Spanish</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="assets/media/flags/germany.svg" alt="" />
													</span>German</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="assets/media/flags/japan.svg" alt="" />
													</span>Japanese</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="assets/media/flags/france.svg" alt="" />
													</span>French</a>
                                </div>
                            </div>
                        </div> -->
                        <div class="menu-item px-5">
                            <a onclick="logout(); return false;" class="menu-link px-5">Sign Out</a>
                        </div>
                    </div>
                </div>
                <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
                    <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_header_menu_toggle">
                        <i class="ki-duotone ki-element-4 fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const walletIcon = document.getElementById('kt_menu_wallet_icon');
        const walletPopup = document.getElementById('wallet-popup');

        function showPopup() {
            if (walletPopup) walletPopup.style.display = 'block';
        }

        function hidePopup() {
            if (walletPopup) walletPopup.style.display = 'none';
        }

        walletPopup?.addEventListener('mouseover', showPopup);
        walletPopup?.addEventListener('mouseleave', hidePopup);
    });

    class Cards {
        constructor(data) {
            this.carts = data;
        }

        create() {
            let data = "";
            this.carts.forEach(cart => {
                data += `
                <div class="card_item d-flex align-items-sm-center mb-7">
                    <div class="symbol symbol-50px me-5">
                        <i class="ki-duotone ki-package fs-2 text-success"></i>
                    </div>
                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <a href="#" class="text-gray-800 text-hover-primary fs-7 fw-bold">${cart.title}</a>
                            <span class="text-muted fw-semibold d-block fs-7">${cart.type}</span>
                        </div>
                        <span class="badge badge-light fw-bold my-2"><span>+</span><span class="Cart_amount">${cart.price ?? 0}</span><span>$</span></span>
                        <button onclick="deleteCard(this, ${cart.id})" class="btn btn-icon btn-active-color-danger btn-sm ml-4">
                            <i class="ki-duotone ki-trash fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </button>
                    </div>
                </div>`;
            });
            return data;
        }


        price() {
            return this.carts.reduce((acc, cart) => acc + (cart.price || 0), 0);
        }
    }

    const CartData = () => {
        const url = `website/carts/${getUserId()}`;
        getRequest(url,
            function (response) {
                if (response.data.status === "Failed") {
                    document.querySelector('#btn_Cards').classList.add("d-none");
                    return;
                }

                const responseData = response.data.data;
                const carts = new Cards(responseData);
                document.querySelector("#Carts").innerHTML = carts.create();
                document.querySelector("#price_cards").innerText = (carts.price() ?? 0) + "$";
            },
            function (error) {
                document.querySelector('#btn_Cards').classList.add("d-none");
                redirectToLoginIfUnauthorized(error);
            }
        );
    }

    function deleteCard(element, id) {
        const url = `website/carts/${id}`;

        deleteRequest(url,
            function (response) {
                if (response.data.status) {
                    const Father = element.closest('.card_item');
                    let price = parseFloat(document.querySelector("#price_cards").innerText.replace('$', ''));
                    let deleted = parseFloat(Father.querySelector(".Cart_amount").innerText);

                    let total = (price - deleted).toFixed(2);
                    if (total <= 0) {
                        document.querySelector('#btn_Cards').classList.add("d-none");
                        document.querySelector("#Carts").innerHTML = `<span class="fs-3 text-danger d-flex justify-content-center fw-bold mb-7">Cart is empty</span>`;
                    }

                    document.querySelector("#price_cards").innerText = total + "$";
                    Father.remove();
                    // location.reload();
                }
            },
            function (error) {
                redirectToLoginIfUnauthorized(error);
            }
        );
    }

    CartData();
    document.getElementById('header-dashboard').addEventListener('click', function() {window.location.href = '/';});
</script>
