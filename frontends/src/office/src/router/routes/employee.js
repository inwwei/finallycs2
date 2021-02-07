export default [
  {
    path: '/employee/Index',
    name: 'employeeIndex',
    component: () => import('@/views/employee/Index.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบพนักงาน',
        },
        {
          text: 'ข้อมูลพนักงานทั้งหมด',
          active: true,
        },
      ],
    },
  },
  {
    path: '/employee/Add',
    name: 'employeeAdd',
    component: () => import('@/views/employee/Add.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบพนักงาน',
        },
        {
          text: 'ข้อมูลพนักงานทั้งหมด',
          to: '/employee/Index',
        },
        {
          text: 'เพิ่มข้อมูลพนักงาน',
          active: true,
        },
      ],
    },
  },
  {
    path: '/employee/Info',
    name: 'employeeInfo',
    component: () => import('@/views/employee/Info.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบพนักงาน',
        },
        {
          text: 'ข้อมูลพนักงานทั้งหมด',
          to: '/employee/Index',
        },
        {
          text: 'ข้อมูลส่วนตัวพนักงาน',
          active: true,
        },
      ],
    },
  },
  {
    path: '/employee/Edit',
    name: 'employeeEdit',
    component: () => import('@/views/employee/Edit.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบพนักงาน',
        },
        {
          text: 'ข้อมูลพนักงานทั้งหมด',
          to: '/employee/Index',
        },
        {
          text: 'แก้ไขข้อมูลพนักงาน',
          active: true,
        },
      ],
    },
  },
]
