// Mapping of role_id to role names
const roleMapping = {
    1: 'supervisor',
    2: 'admin',
    3: 'client'
};

// RBAC configuration
const rbac = {
    '': ['supervisor', 'client', 'admin'],
    'register': ['guest'],
    'login': ['guest'],
    'add-website': ['supervisor', 'client', 'admin'],
    'my-website': ['supervisor', 'client', 'admin'],
    'website-setting': ['supervisor', 'client', 'admin'],
    '404': ['*'],
    '403': ['*'],
    '500': ['*'],
    'social-media-marketing': ['supervisor', 'client', 'admin'],
    'social-media-marketing-option': ['supervisor', 'client', 'admin'],
    'scraper': ['supervisor', 'client', 'admin'],
    'scraper-option': ['supervisor', 'client', 'admin'],
    'payment': ['supervisor', 'client', 'admin'],
    'payment-option': ['supervisor', 'client', 'admin'],
    'ai': ['supervisor', 'client', 'admin'],
    'blog-creation': ['supervisor', 'client', 'admin'],
    'check-out': ['supervisor', 'client', 'admin'],
    'my-transaction': ['supervisor', 'client', 'admin'],
    'successful-transaction': ['supervisor', 'client', 'admin'],
    'failed-transaction': ['supervisor', 'client', 'admin'],
    'package': ['supervisor', 'client', 'admin'],
    'my-package': ['supervisor', 'client', 'admin'],
    'api-docs': ['supervisor', 'client', 'admin'],
    // 'plugin': ['supervisor', 'client', 'admin'],
    'profile': ['client', 'supervisor', 'admin'],
    // 'support': ['supervisor', 'client', 'admin']
};

// Menu titles
const menuTitle = {
    '': { title: 'Dashboard' },
    'register': { title: 'Register' },
    'login': { title: 'Login' },
    'add-website': { title: 'Add Website' },
    'my-website': { title: 'My Website' },
    'website-setting': { title: 'Website Settings' },
    '404': { title: '404 Error' },
    '403': { title: '403 Error' },
    '500': { title: '500 Error' },
    'social-media-marketing': { title: 'Social Media Marketing' },
    'social-media-marketing-option': { title: 'Social Media Marketing Options' },
    'scraper': { title: 'Social Fetch Data' },
    'scraper-option': { title: 'Scraper Options' },
    'payment': { title: 'Payment' },
    'payment-option': { title: 'Payment Options' },
    'ai':{title: 'AI'},
    'check-out': { title: 'Checkout' },
    'my-transaction': { title: 'My Transactions' },
    'successful-transaction': { title: 'Successful Transactions' },
    'failed-transaction': { title: 'Failed Transactions' },
    'profile': { title: 'Profile' },
    'package': { title: 'Package' },
    'my-package': { title: 'My Package' },
    'api-docs': { title: 'API Documentation' },
    // 'plugin': { title: 'Plugin' },
    // 'support': { title: 'Support' }
};

// Categories and their associated menu items with icons
const categories = {
    'Home': { items: [''], submenu: false, icon: '' },
    'Services': { items: ['social-media-marketing', 'scraper', 'payment', 'ai'], submenu: true, icon: 'ki-duotone ki-element-plus' },
    'Wallet': { items: ['my-transaction', 'check-out'], submenu: true, icon: 'ki-duotone ki-wallet' },
    'Packages': { items: ['package', 'my-package'], submenu: true, icon: 'ki-duotone ki-package' },
    'API & Plugins': { items: ['api-docs'/*,'plugin'*/], submenu: true, icon: 'ki-duotone ki-square-brackets' },
    'Profile and Support': { items: ['profile'/*, 'support'*/], submenu: false, icon: '' }
};



// Initialize RBAC and build the sidebar menu
function initRbac() {
    let sidebar = document.getElementById('kt_app_sidebar_menu');
    if (!sidebar) return;
    sidebar.innerHTML = '';

    // Get role IDs from localStorage and convert them to role names
    let roleIds = localStorage.getItem('role_id') || '3'; // Default to 'client' if not found
    roleIds = roleIds.split(',').map(id => roleMapping[id]).filter(role => role);

    // Get the current page path to set the active link
    let currentPage = window.location.pathname.split('/').pop().split('.').shift();

    // Add categories to the sidebar
    Object.keys(categories).forEach(category => {
        const { items, submenu, icon } = categories[category];
        const visibleItems = items.filter(item => roleIds.some(role => rbac[item].includes(role) || rbac[item].includes('*')));

        if (visibleItems.length > 0) {
            addCategoryToSidebar(category, visibleItems, submenu, currentPage, icon);
        }
    });

    const menuItems = document.querySelectorAll('.menu-accordion > .menu-link');
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            const parentItem = this.closest('.menu-accordion');
            if (parentItem) {
                parentItem.classList.toggle('show');
            }
        });
    });
}

// Add a category and its items to the sidebar
function addCategoryToSidebar(category, items, hasSubmenu, currentPage, icon) {
    let sidebar = document.getElementById('kt_app_sidebar_menu');
    if (!sidebar) return;

    const isActiveCategory = items.some(item => currentPage === item);

    sidebar.innerHTML += `
        <div class="menu-item ${hasSubmenu ? 'menu-accordion' : ''} ${isActiveCategory ? 'show' : ''}">
            ${hasSubmenu ? `
                <span class="menu-link ${isActiveCategory ? 'active' : ''}">
                    <span class="menu-icon">
                        <i class="${icon} fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </span>
                    <span class="menu-title">${category}</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    ${items.map(item => getMenuItem(item, menuTitle[item], currentPage)).join('')}
                </div>
            ` : `
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">
                        <i class="${icon} fs-2 me-2"></i>${category}
                    </span>
                </div>
                ${items.map(item => getMenuItem(item, menuTitle[item], currentPage)).join('')}
            `}
        </div>
    `;
}

// Generate HTML for a menu item
function getMenuItem(menuItem, titleObj, currentPage) {

    // Determine if the menu item is active
    const isActive = currentPage === menuItem ? 'active' : '';
    return `
        <div class="menu-item">
            <a class="menu-link ${isActive}" id="${menuItem}" href="/${menuItem}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">${titleObj.title}</span>
            </a>
        </div>`;
}

// Initialize the RBAC system on page load
document.addEventListener('DOMContentLoaded', initRbac );

document.addEventListener('DOMContentLoaded', function () {
    getRequest(
        `/website/user_services`,

        function (response) {

            if (
                response.data.data.smm === null &&
                response.data.data.payment === null &&
                response.data.data.scraper === null &&
                response.data.data.ai === null
            ) {
                const myPackgeElement = document.getElementById('my-package');
                myPackgeElement.removeAttribute('href');
                myPackgeElement.style.cursor = 'not-allowed';
                myPackgeElement.addEventListener('click', function(event) {
                    showAlert('warning', 'You don\'t have any packages.', 'First, you need to purchase a package to view them in "My Packages".');
                    setTimeout(function() {
                        window.location.href = "/package";
                    }, 1500);
                    return;
                });
            }

            if (response.data.data.smm == null) {
                const ssmElement = document.getElementById('social-media-marketing');
                ssmElement.removeAttribute('href');
                ssmElement.style.cursor = 'not-allowed';
                ssmElement.addEventListener('click', function(event) {
                showAlert('warning', 'You don\'t have Social Media Marketing package.', 'First, you need to buy a package in order to use the services.');
                    setTimeout(function() {
                        window.location.href = "/package";
                    }, 1500);
                    return;
                });
            }
            if (response.data.data.payment == null) {
                const paymentEnabled = document.getElementById('payment');
                paymentEnabled.removeAttribute('href');
                paymentEnabled.style.cursor = 'not-allowed';
                paymentEnabled.addEventListener('click', function(event) {
                    showAlert('warning', 'You don\'t have Payment package.', 'First, you need to buy a package in order to use the services.');
                    setTimeout(function() {
                        window.location.href = "/package";
                    }, 1500);
                    return;
                });
            }
            if (response.data.data.scraper == null){
                const scraperElement = document.getElementById('scraper');
                scraperElement.removeAttribute('href');
                scraperElement.style.cursor = 'not-allowed';
                scraperElement.addEventListener('click', function(event) {
                    showAlert('warning', 'You don\'t have Scraper package.', 'First, you need to buy a package in order to use the services.');
                    setTimeout(function() {
                        window.location.href = "/package";
                    }, 1500);
                    return;
                });

            }
            if (response.data.data.ai !== null){
                const aiElement = document.getElementById('Ai');
                aiElement.removeAttribute('href');
                aiElement.style.cursor = 'not-allowed';
                aiElement.addEventListener('click', function(event) {
                    showAlert('warning', 'You don\'t have Ai package.', 'First, you need to buy a package in order to use the services.');
                    setTimeout(function() {
                        window.location.href = "/package";
                    }, 1500);
                    return;
                });

            }
        },
        function (error) {
            redirectToLoginIfUnauthorized(error);
        }
    );
});
