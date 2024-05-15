CREATE TABLE `user` (
    `user_id` int NOT NULL AUTO_INCREMENT,
    `full_name` varchar(30),
    `email` varchar(30),
    `password` varchar(30),
    `role` enum('admin', 'basic'),
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`user_id`)
) ENGINE = InnoDB;

INSERT INTO
    `user`
VALUES (
        16,
        'admin',
        'admin@gmail.com',
        'admin',
        'admin',
        '2024-04-21 12:09:23',
        '2024-04-21 12:09:23'
    );

CREATE TABLE `doctor` (
    `doctor_id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(40),
    `specialization` varchar(30),
    `phone` varchar(30),
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`doctor_id`)
) ENGINE = InnoDB;

INSERT INTO
    `doctor`
VALUES (
        1,
        'Dr. John Does',
        'asdCardiologysssiaaaaa',
        '082329135125',
        '2024-04-21 20:33:40',
        '2024-04-21 20:33:40'
    ),
    (
        2,
        'Dr. Jane Smith',
        'Neurology',
        '082329135125',
        '2024-04-21 20:33:40',
        '2024-04-21 20:33:40'
    ),
    (
        3,
        'Dr. Michael Johnson',
        'Pediatrics',
        '082329135125',
        '2024-04-21 20:33:40',
        '2024-04-21 20:33:40'
    ),
    (
        4,
        'Dr. Emily Williams',
        'Dermatology',
        '082329135125',
        '2024-04-21 20:33:40',
        '2024-04-21 20:33:40'
    ),
    (
        5,
        'Dr. David Brown',
        'Orthopedics',
        '082329135125',
        '2024-04-21 20:33:40',
        '2024-04-21 20:33:40'
    ),
    (
        6,
        'Dr. Sarah Anderson',
        'Oncology',
        '082329135125',
        '2024-04-21 20:33:40',
        '2024-04-21 20:33:40'
    ),
    (
        7,
        'Dr. James Wilson',
        'Psychiatry',
        '082329135125',
        '2024-04-21 20:33:40',
        '2024-04-21 20:33:40'
    ),
    (
        8,
        'Dr. Laura Martinez',
        'Endocrinology',
        '082329135125',
        '2024-04-21 20:33:40',
        '2024-04-21 20:33:40'
    ),
    (
        9,
        'Dr. William Taylor',
        'Urology',
        '082329135125',
        '2024-04-21 20:33:40',
        '2024-04-21 20:33:40'
    ),
    (
        10,
        'Dr. Elizabeth Clark',
        'Gastroenterology',
        '082329135125',
        '2024-04-21 20:33:40',
        '2024-04-21 20:33:40'
    );

CREATE TABLE `hospital` (
    `hospital_id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100),
    `address` varchar(255),
    `phone` varchar(13),
    `email` varchar(50),
    `website` varchar(100),
    `description` text,
    `rating` int DEFAULT '0',
    `num_ratings` int DEFAULT '0',
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `image` varchar(150),
    PRIMARY KEY (`hospital_id`)
) ENGINE = InnoDB;

INSERT INTO
    `hospital`
VALUES (
        130,
        'RS Pondok Indah - Pondok Indah',
        'Jalan Metro Duta Kav. UE, Pd. Pinang, Kec. Kby. Lama, Daerah Khusus Ibukota Jakarta 12310',
        '62217657525',
        'cr.pondokindah@rspondokindah.co.id',
        'http://rspondokindah.co.id',
        'Rumah Sakit Pondok Indah adalah rumah sakit unggulan yang berlokasi di Jakarta. Rumah sakit ini menyediakan berbagai layanan kesehatan terbaik dengan teknologi canggih dan tenaga medis terbaik.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        131,
        'RSKB Columbia Asia Pulomas',
        'Jl. Kayu Putih Raya No.1, RT.10/RW.16, Kayu Putih, Kec. Pulo Gadung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13210',
        '1996010160093',
        'customercare.medan@columbiaasia.com',
        'http://www.columbiaasia.com/indonesia/services/pulomas',
        'Rumah Sakit Columbia Asia – PULOMAS, is a multi-specialty hospital in Jakarta. The hospital has 139 beds including larger Emergency Room, larger Critical Area with total 12 beds including ICU, ICCU, HDU, NICU, PICU, and new sophisticated medical equipment i.e. Angiography/Catheterization Laboratory, Chemotherapy (for Oncology services), Microbiology Laboratory, EEG, PCNL (for Urology service). Hospital built up in 7.060 m2 area to provide more than 12 Million of population in Jakarta with highly qualified medical services. It commenced operation from September 2014 and recognized as one of the best hospitals in East Jakarta.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        132,
        'RSUD Tarakan Jakarta',
        'Jl. Kyai Caringin No.7, RT.11/RW.4, Cideng, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10150',
        '6282110691289',
        'rsudtarakan@jakarta.go.id',
        'http://rsudtarakan.jakarta.go.id',
        'Rumah Sakit Umum Daerah Tarakan Jakarta adalah rumah sakit pemerintah yang menyediakan layanan kesehatan terbaik di Jakarta Pusat.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        133,
        'Rumah Sakit Islam Jakarta Cempaka Putih',
        'Jl. Cemp. Putih Tengah I No.1, RT.11/RW.5, Cemp. Putih Tim., Kec. Cemp. Putih, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10510',
        '6285850050010',
        'rsijpusat@rsi.co.id',
        'http://www.rsi.co.id',
        'Rumah Sakit Islam Cempaka Putih adalah rumah sakit swasta terkemuka di Jakarta Pusat dengan layanan kesehatan yang komprehensif.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        134,
        'Rumah Sakit Duta Indah',
        'Jl. Teluk Gong Raya No.12, RT.5/RW.17, Pejagalan, Kec. Penjaringan, Jkt Utara, Daerah Khusus Ibukota Jakarta 14450',
        '2023121503',
        'info@rsdutaindah.com',
        'http://www.rsdutaindah.com',
        'Rumah Sakit Duta Indah adalah rumah sakit yang menyediakan layanan kesehatan berkualitas tinggi di Jakarta Utara.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        135,
        'MRCCC Siloam Hospitals Semanggi',
        'Jl. Garnisun 1 No.2-3 5, RT.5/RW.4, Karet Semanggi, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12930',
        '06188881900',
        'josephine.darmawan@siloamhospitals.com',
        'http://siloamhospitals.com/',
        'MRCCC Siloam Hospitals Semanggi adalah rumah sakit yang menyediakan layanan kesehatan terbaik di Jakarta Selatan dengan fasilitas modern dan tenaga medis profesional.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        136,
        'Rumah Sakit Pelni',
        'Jl. K.S. Tubun No.92 - 94, RT.10/RW.1, Slipi, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11410',
        '622127899859',
        'pemasaran@rspelni.co.id',
        'http://www.rspelni.co.id',
        'Rumah Sakit Pelni adalah rumah sakit yang terletak di Jakarta Barat dengan layanan kesehatan terbaik untuk masyarakat sekitar.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        137,
        'RSUD Pasar Minggu',
        'Jl. TB Simatupang No.1 1, RT.10/RW.5, Ragunan, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12550',
        '02129059999',
        'info.rsudpasarminggu@jakarta.go',
        'http://rsudpasarminggu.jakarta.id',
        'Rumah Sakit Umum Daerah Pasar Minggu atau Rumah Sehat untuk Jakarta – RSUD Pasar Minggu adalah sebuah rumah sakit milik pemerintah yang terletak di Kota Jakarta Selatan, DKI Jakarta, Indonesia. Nama rumah sakit ini diambil dari nama daerah, yakni kecamatan Pasar Minggu.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        138,
        'Rumah Sakit Harapan Bunda',
        'Jl. Raya Jakarta-Bogor KM.22 No.44, RT.8/RW.2, Rambutan, Kec. Ciracas, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13830',
        '0218400257',
        'sdmrekrutmen.rssmcikarang@gmail.co',
        'http://extraedihsita.com/spital/harapan-bunda',
        'Rumah Sakit Harapan Bunda (HB) adalah rumah sakit swasta yang menyediakan layanan kesehatan terbaik di Jakarta Timur.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        139,
        'RSUD Tugu Koja',
        'Jl. Walang Permai No.39, RT.7/RW.12, Tugu Sel., Kec. Koja, Jkt Utara, Daerah Khusus Ibukota Jakarta 14260',
        '6281340003614',
        'rsudtugukoja@jakarta.go.id',
        'http://rsudtugukoja.jakarta.go.id',
        'Rumah Sakit Umum Daerah Tugu Koja adalah salah satu rumah sakit pemerintah yang terletak di Jakarta Utara.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        140,
        'RSU Hermina Podomoro',
        'Blok E 3, Jl. Danau Agung 2 No.28 - 30, RT.3/RW.16, Sunter Agung, Kec. Tj. Priok, Jkt Utara, Daerah Khusus Ibukota Jakarta 14350',
        '627518972525',
        'help@herminahospitals.com',
        'http://herminahospitals.com/id/banci/hermina-podomoro',
        'RSU Hermina Podomoro merupakan rumah sakit yang menyediakan berbagai layanan kesehatan terbaik di Jakarta Utara.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        141,
        'Siloam Hospitals Kebon Jeruk',
        'Jl. Perjuangan No.8, RT.14/RW.10, Kb. Jeruk, Kec. Kb. Jeruk, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11530',
        '628118951181',
        'josephine.darmawan@siloamhospitals.com',
        'http://siloamhospitals.com/',
        'Siloam Hospitals Kebon Jeruk adalah rumah sakit swasta terkemuka di Jakarta Barat dengan layanan kesehatan terbaik.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        142,
        'Rumah Sakit Umum Pusat Fatmawati',
        'PQ3W+WFJ, Jl. RS. Fatmawati Raya, Cilandak Bar., Kec. Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12430',
        '0217501524',
        'rsupf@fatmawatihospital.com',
        'http://rsupfatmawati.id/',
        'RS Fatmawati didirikan pada tahun 1954 oleh Ibu Fatmawati Soekarno. sebagai RS yang mengkhususkan Penderita TBC Anak dan Rehabilitasinya. Pada tanggal 15 April 1961 penyelenggaraan dan pembiayaan RS Fatmawati diserahkan kepada Departemen Kesehatan sehingga tanggal tersebut ditetapkan sebagai hari jadi RS Fatmawati. Dalam perjalanan RS Fatmawati, tahun 1984 ditetapkan sebagai Pusat Rujukan Jakarta Selatan dan tahun 1994 ditetapkan sebagai RSU Kelas B Pendidikan.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        143,
        'RSUD Cengkareng',
        'Jl. Kamal Raya Outer Ring Road Jl. Bumi Cengkareng Indah No.1, RT.13/RW.10, Cengkareng Tim., Kecamatan Cengkareng, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11730',
        '622154372874',
        'marketingrs@rsudcengkareng.com',
        'http://rsudcengkareng.com',
        'RSUD Cengkareng merupakan Rumah Sakit Umum Daerah pertama yang berada di wilayah Jakarta Barat. Rumah sakit ini dibangun di atas lahan 26.000 m2 dengan luas bangunan 31.600 M2. Berawal pada tahun 1999, Walikota Jakarta Barat mengusulkan pembangunan RSUD untuk wilayah Jakarta Barat, dengan cara menyediakan tanah fasilitas sosial/ fasilitas umum yang diberikan Perumnas untuk dijadikan sebuah rumah sakit. Pada saat yang sama, Kepala Dinas Kesehatan DKI Jakarta juga mengusulkan pembangunan RSUD tersebut kepada Gubernur, melalui Sekertaris Daerah Provinsi DKI Jakarta, dan akhirnya Gubernur DKI Jakarta menyetujui pembangunan RSUD Cengkareng.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        144,
        'RUMAH SAKIT TEBET',
        'Jl. Letjen M.T. Haryono No.Kav.13, Tebet Bar., Kec. Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12810',
        '021830754044',
        'marketing@rstebet.co.id',
        'http://www.rstebet.co.id',
        'Rumah Sakit Umum Kecamatan Tebet mempunyai tugas melaksanakan upaya kesehatan secara berdaya guna, mengupayakan penyembuhan dan pemulihan secara serasi dan terpadu dalam upaya peningkatan kualitas kesehatan bagi seluruh lapisan masyarakat, khususnya masyarakat yang kurang mampu.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        145,
        'Rumah Sakit Mitra Keluarga Kemayoran',
        'Jl. HBR Motik, RT.13/RW.6, Kb. Kosong, Kec. Kemayoran, Jkt Pusat, Daerah Khusus Ibukota Jakarta 10630',
        '081280000911',
        'web@mitrakeluarga.com',
        'http://www.mitrakeluarga.com/fasilitas',
        'Rumah Sakit Mitra Keluarga Kemayoran adalah salah satu rumah sakit yang menyediakan layanan kesehatan terbaik di Jakarta Pusat.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        146,
        'Rumah Sakit Yadika Pondok Bambu',
        'Jl. Pahlawan Revolusi No.47, RT.5/RW.5, Pd. Bambu, Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13430',
        '08111033318',
        'marketing.rsypb@yahoo.com',
        'http://www.rsypb.com/',
        'Rumah Sakit Yadika Pondok Bambu adalah salah satu rumah sakit yang bertekad untuk memberikan pelayanan kesehatan terbaik kepada masyarakat sekitar.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        147,
        'Rumah Sakit Pusat Otak Nasional Prof. Dr. dr. Mahar Mardjono Jakarta',
        'Jl. Letjen M.T. Haryono No.Kav.11, Cawang, Kec. Kramat jati, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13630',
        '02129373377',
        'info@rspon.co.id',
        'http://www.rspon.co.id/',
        'Rumah Sakit Pusat Otak Nasional Prof. Dr. dr. Mahar Mardjono Jakarta merupakan salah satu rumah sakit yang memiliki peran penting dalam pelayanan kesehatan di Indonesia.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        148,
        'RSUD Kembangan',
        'Jl. Topas Raya Blok FII No.03, RT.15/RW.7, Meruya Utara, Kec. Kembangan, Kota Jakarta Barat, Banten 11620',
        '0215870834',
        'rsukembangan@gmail.com',
        'http://www.rsukembangan.co/',
        'RSUD Kembangan merupakan rumah sakit yang terletak di Jakarta Barat dan menjadi salah satu pilihan terbaik dalam fasilitas kesehatan di sekitar Jakarta Barat.',
        0,
        0,
        '2024-05-10 11:27:57',
        '2024-05-10 11:27:57',
        NULL
    ),
    (
        149,
        'Rumah Sakit Husada',
        'Jl. Raya Mangga Besar No.137-139, Mangga Dua Sel., Kecamatan Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10730',
        '0216260108',
        'husada@husada.co.id',
        'http://www.husada.co.id/',
        'Rumah Sakit Husada, dahulu Jang Seng Ie, adalah sebuah rumah sakit umum di Jakarta Pusat, Indonesia. Didirikan sebagai poliklinik oleh Dr. Kwa Tjoan Sioe pada tahun 1924, dan diresmikan penggunaannya pada tahun berikutnya.',
        0,
        0,
        '2024-05-10 11:35:28',
        '2024-05-10 11:35:28',
        NULL
    );

CREATE TABLE `doctor_hospital` (
    `doctor_hospital_id` int NOT NULL AUTO_INCREMENT,
    `doctor_id` int DEFAULT NULL,
    `hospital_id` int DEFAULT NULL,
    `created_at` datetime DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    PRIMARY KEY (`doctor_hospital_id`),
    KEY `doctor_id` (`doctor_id`),
    KEY `hospital_id` (`hospital_id`),
    CONSTRAINT `doctor_hospital_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
    CONSTRAINT `doctor_hospital_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`)
) ENGINE = InnoDB;

INSERT INTO
    `doctor_hospital` (
        `doctor_id`,
        `hospital_id`,
        `created_at`,
        `updated_at`
    )
SELECT
    FLOOR(RAND() * 10) + 1 AS `doctor_id`,
    FLOOR(RAND() * 20) + 130 AS `hospital_id`,
    NOW() AS `created_at`,
    NOW() AS `updated_at`
FROM INFORMATION_SCHEMA.TABLES
LIMIT 100;

CREATE TABLE `rating` (
    `rating_id` int NOT NULL AUTO_INCREMENT,
    `hospital_id` int DEFAULT NULL,
    `user_id` int DEFAULT NULL,
    `rating_value` int DEFAULT NULL,
    `comment` text,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`rating_id`),
    KEY `hospital_id` (`hospital_id`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`),
    CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE = InnoDB;

CREATE TABLE `recommendation` (
    `recommendation_id` int NOT NULL AUTO_INCREMENT,
    `user_id` int DEFAULT NULL,
    `hospital_id` int DEFAULT NULL,
    PRIMARY KEY (`recommendation_id`),
    KEY `user_id` (`user_id`),
    KEY `hospital_id` (`hospital_id`),
    CONSTRAINT `recommendation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
    CONSTRAINT `recommendation_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`)
) ENGINE = InnoDB;
