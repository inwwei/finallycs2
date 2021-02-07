import Vue from 'vue'
import moment from 'moment'

// const { vsprintf } = require('sprintf-js')

Vue.mixin({
  methods: {
    beforeDateSendDB(date) {
      const b = date.split('/')
      b[2] -= 543
      return `${b[0]}/${b[1]}/${b[2]}`
    },
    /**
     * แยกข้อมูลออกจาก master data
     * @note เอาไว้แยกข้อมูลออกมาจากข้อมูลหลัก เวลาแก้แล้วจะไม่ไปกระทบกับตับ master data
     * @param {Object} src
     */
    coppyParam(src) {
      return JSON.parse(JSON.stringify(src))
    },
    cp(src) {
      return JSON.parse(JSON.stringify(src))
    },
    /**
     * =========================
     */

    // sprint(master, text) {
    //   return vsprintf(master, [`${text}`])
    // },
    /**
     * แปลง วันที่ ที่ดึงมาจากฐานข้อมูลให้อยู่ในรูปแบบ วัน เดือน ปี
     * @param {date} date วัน/เดือน/ปี Example: 01/02/2563
     * @return  ปี/เดือน/วัน Example: 2020-02-01
     */
    convertDateDB(date) {
      return moment(date.convertDate(), 'DD/MM/YYYY').format('YYYY-MM-DD')
    },
    /**
     * แปลง คศ เป็น พ.ศ
     * @param {date} date
     * @param {Object}
     *  fulldate true แสดง วัน เดือน ปี เต็ม / false แบบตัวเลข
     *  abb แสดงเดือนเป็นแบบตัวย่อ
     */
    convertDateToThai(date, options = { fulldate: false, abb: false }) {
      if (!date) return ''

      const { fulldate, abb } = options
      const convertDate = moment(date).format('DD/MM/YYYY')
      // .convertDate()
      if (fulldate) {
        return this.DateThai(convertDate, abb)
      }
      return convertDate
    },
    DateThai(strDate, abb) {
      const splitDate = strDate.split('/')
      const monthNamesThai = [
        'มกราคม',
        'กุมภาพันธ์',
        'มีนาคม',
        'เมษายน',
        'พฤษภาคม',
        'มิถุนายน',
        'กรกฎาคม',
        'สิงหาคม',
        'กันยายน',
        'ตุลาคม',
        'พฤษจิกายน',
        'ธันวาคม',
      ]
      const monthNamesThaiAbb = [
        'ม.ค.',
        'ก.พ.',
        'มี.ค.',
        'เม.ย.',
        'พ.ค.',
        'มิ.ย.',
        'ก.ค.',
        'ส.ค.',
        'ก.ย.',
        'ต.ค.',
        'พ.ย.',
        'ธ.ค.',
      ]

      const dayNames = [
        'วันอาทิตย์ที่',
        'วันจันทร์ที่',
        'วันอังคารที่',
        'วันพุทธที่',
        'วันพฤหัสบดีที่',
        'วันศุกร์ที่',
        'วันเสาร์ที่',
      ]

      if (abb) {
        return `${splitDate[0]} ${monthNamesThaiAbb[
          splitDate[1] - 1
        ]} ${splitDate[2] * 1 + 543}`
      }
      return `${splitDate[0]} ${monthNamesThai[
        splitDate[1] - 1
      ]} ${splitDate[2] * 1 + 543}`
    },
    withCommas(number, decimal = true) {
      if (number) {
        let temp
        if (decimal) {
          temp = parseFloat(number, 10).toFixed(2).split('.')
          return `${parseFloat(temp[0], 10).toLocaleString()}.${temp[1]}`
        }
        temp = parseFloat(number, 10)
        return `${parseFloat(temp, 10).toLocaleString()}`

        // return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
      }
      return number
    },
    withoutCommas(number) {
      number.replace(',', '')
    },
    objectToFormData(data) {
      const payload = new FormData()
      /**
       * วนลูปเอา key ของ object มากำหนด
       * เป็น index สำหรับส่งไป server
       */
      //   for (const i in data) {
      //     // เช็คว่าเป็น Array หรือไม่
      //     if (data[i] instanceof Array) {
      //       arrayToForm(payload, data[i], i)
      //     } else if (data[i] instanceof File) {
      //       payload.append(i, data[i], data[i].name)
      //     } else if (typeof data[i] === 'object') {
      //       // เผื่อกรณีมี object ซ้อน object
      //       for (const j in data[i]) {
      //         appendType(payload, data[i][j], `${i}[${j}]`)
      //       }
      //     } else {
      //       appendType(payload, data[i], i)
      //     }
      //   }
      return payload
    },
    replacer(key, value) {
      // Filtering out properties
      if (value === null) {
        return undefined
      }
      return value
    },
    // replaceDate(data) {
    //   if (!data) {
    //     return data
    //   }
    //   if (data instanceof Array) {
    //     data.map(item => {
    //       if (typeof item === 'object') {
    //         this.replaceDate(item)
    //       } else {
    //         item = checkConvert(item)
    //       }
    //     })
    //   } else {
    //     Object.keys(data).map(key => {
    //       if (typeof data[key] === 'object') {
    //         this.replaceDate(data[key])
    //       } else {
    //         data[key] = checkConvert(data[key])
    //       }
    //     })
    //   }
    //   return data
    // },
    // convertDate(data) {
    //   return checkConvert(data)
    // },
    urltoFile(url, filename, mimeType) {
      return fetch(url)
        .then(res => res.arrayBuffer())
        .then(buf => new File([buf], filename, { type: mimeType }))
    },
  },
})

// const arrayToForm = (payload, data, formKey) => {
//   if (data instanceof Array) {
//     // ลูปเอาค่าใน array ไปใช้
//     data.map((item, key) => {
//       doObject(payload, item, `${formKey}[${key}]`)
//     })
//   } else {
//     for (const i in data) {
//       doObject(payload, data[i], `${formKey}[${i}]`)
//     }
//   }
// }
