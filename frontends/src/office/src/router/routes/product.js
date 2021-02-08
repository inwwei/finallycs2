export default [
  {
    path: '/product/TenderNotice',
    name: 'TenderNotice',
    component: () => import('@/views/product/TenderNotice.vue'),
    meta: {
      pageTitle: 'ข้อมูลสินค้า',
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'ข้อมูลสินค้าทั้งหมด',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/Pricechart',
    name: 'Pricechart',
    component: () => import('@/views/product/Pricechart.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'ข้อมูลสินค้าทั้งหมด',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/CompanyRegistered',
    name: 'CompanyRegistered',
    component: () => import('@/views/product/CompanyRegistered.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'ข้อมูลสินค้าทั้งหมด',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/MinistryOfCommerceInformation',
    name: 'MinistryOfCommerceInformation',
    component: () => import('@/views/product/MinistryOfCommerceInformation.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'ข้อมูลสินค้าทั้งหมด',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/ManageShop',
    name: 'ManageShop',
    component: () => import('@/views/product/ManageShop.vue'),
    meta: {
      pageTitle: 'ข้อมูลสินค้าทั้งหมด',
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'รายการขายสินค้าทั้งหมด',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/ManageShop/Menu',
    name: 'Menu',
    component: () => import('@/views/product/Menu.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'รายการขายสินค้าทั้งหมด',
        },
        {
          text: 'ขายสินค้า',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/ManageShop/Profiles',
    name: 'Profiles',
    component: () => import('@/views/product/Profiles.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'รายการขายสินค้าทั้งหมด',
        },
        {
          text: 'ขายสินค้า',
          active: true,
        },
      ],
    },
  },
]
