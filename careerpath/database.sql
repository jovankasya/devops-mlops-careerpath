CREATE DATABASE IF NOT EXISTS careerpath
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE careerpath;

CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    role ENUM('mahasiswa', 'hrd') NOT NULL,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(191) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_users_email (email),
    KEY idx_users_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS student_profiles (
    user_id BIGINT UNSIGNED NOT NULL,
    nim VARCHAR(30) NOT NULL,
    university VARCHAR(150) NOT NULL,
    major VARCHAR(120) NOT NULL,
    phone VARCHAR(30) DEFAULT NULL,
    cv_path VARCHAR(255) DEFAULT NULL,
    bio TEXT DEFAULT NULL,
    job_search_status ENUM('aktif', 'pasif') NOT NULL DEFAULT 'aktif',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id),
    UNIQUE KEY uq_student_profiles_nim (nim),
    CONSTRAINT fk_student_profiles_user
        FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS companies (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    sector VARCHAR(100) DEFAULT NULL,
    website VARCHAR(255) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    logo_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_companies_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS company_members (
    company_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    position_title VARCHAR(120) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (company_id, user_id),
    UNIQUE KEY uq_company_members_user (user_id),
    CONSTRAINT fk_company_members_company
        FOREIGN KEY (company_id) REFERENCES companies (id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_company_members_user
        FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS jobs (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    company_id BIGINT UNSIGNED NOT NULL,
    created_by BIGINT UNSIGNED DEFAULT NULL,
    title VARCHAR(150) NOT NULL,
    department VARCHAR(100) DEFAULT NULL,
    description TEXT NOT NULL,
    qualifications TEXT NOT NULL,
    location VARCHAR(120) NOT NULL,
    work_mode ENUM('onsite', 'hybrid', 'remote') NOT NULL DEFAULT 'onsite',
    employment_type ENUM('internship', 'full_time', 'part_time', 'contract') NOT NULL DEFAULT 'internship',
    salary_min DECIMAL(13,2) DEFAULT NULL,
    salary_max DECIMAL(13,2) DEFAULT NULL,
    salary_period ENUM('monthly', 'yearly', 'project') NOT NULL DEFAULT 'monthly',
    quota SMALLINT UNSIGNED NOT NULL DEFAULT 1,
    deadline DATE DEFAULT NULL,
    status ENUM('draft', 'published', 'closed') NOT NULL DEFAULT 'published',
    logo_text VARCHAR(8) DEFAULT NULL,
    logo_background_color CHAR(7) DEFAULT NULL,
    logo_text_color CHAR(7) DEFAULT NULL,
    published_at DATETIME DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_jobs_company_status (company_id, status),
    KEY idx_jobs_status_published (status, published_at),
    KEY idx_jobs_department (department),
    KEY idx_jobs_location (location),
    CONSTRAINT fk_jobs_company
        FOREIGN KEY (company_id) REFERENCES companies (id)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_jobs_creator
        FOREIGN KEY (created_by) REFERENCES users (id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS skills (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_skills_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS student_skills (
    student_id BIGINT UNSIGNED NOT NULL,
    skill_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (student_id, skill_id),
    CONSTRAINT fk_student_skills_student
        FOREIGN KEY (student_id) REFERENCES student_profiles (user_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_student_skills_skill
        FOREIGN KEY (skill_id) REFERENCES skills (id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS job_skills (
    job_id BIGINT UNSIGNED NOT NULL,
    skill_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (job_id, skill_id),
    CONSTRAINT fk_job_skills_job
        FOREIGN KEY (job_id) REFERENCES jobs (id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_job_skills_skill
        FOREIGN KEY (skill_id) REFERENCES skills (id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS applications (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    job_id BIGINT UNSIGNED NOT NULL,
    student_id BIGINT UNSIGNED NOT NULL,
    cv_path VARCHAR(255) DEFAULT NULL,
    cover_letter TEXT DEFAULT NULL,
    status ENUM(
        'submitted',
        'document_review',
        'interview',
        'accepted',
        'rejected',
        'withdrawn'
    ) NOT NULL DEFAULT 'submitted',
    applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_applications_job_student (job_id, student_id),
    KEY idx_applications_student_status (student_id, status),
    KEY idx_applications_job_status (job_id, status),
    CONSTRAINT fk_applications_job
        FOREIGN KEY (job_id) REFERENCES jobs (id)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_applications_student
        FOREIGN KEY (student_id) REFERENCES student_profiles (user_id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS application_status_history (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    application_id BIGINT UNSIGNED NOT NULL,
    changed_by BIGINT UNSIGNED DEFAULT NULL,
    status ENUM(
        'submitted',
        'document_review',
        'interview',
        'accepted',
        'rejected',
        'withdrawn'
    ) NOT NULL,
    note TEXT DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_application_history_application (application_id, created_at),
    CONSTRAINT fk_application_history_application
        FOREIGN KEY (application_id) REFERENCES applications (id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_application_history_user
        FOREIGN KEY (changed_by) REFERENCES users (id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS student_preferences (
    student_id BIGINT UNSIGNED NOT NULL,
    email_application_updates TINYINT(1) NOT NULL DEFAULT 1,
    weekly_job_recommendations TINYINT(1) NOT NULL DEFAULT 0,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (student_id),
    CONSTRAINT fk_student_preferences_student
        FOREIGN KEY (student_id) REFERENCES student_profiles (user_id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS notifications (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    target_url VARCHAR(255) DEFAULT NULL,
    read_at DATETIME DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_notifications_user_read (user_id, read_at, created_at),
    CONSTRAINT fk_notifications_user
        FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO companies (id, name, sector) VALUES
    (1, 'Gojek Indonesia', 'Teknologi & Informasi'),
    (2, 'Tokopedia', 'Teknologi & Informasi'),
    (3, 'BNI', 'Keuangan'),
    (4, 'Shopee', 'Teknologi & E-commerce'),
    (5, 'Traveloka', 'Teknologi & Pariwisata'),
    (6, 'Bank Mandiri', 'Keuangan')
ON DUPLICATE KEY UPDATE
    sector = VALUES(sector);

INSERT INTO skills (id, name) VALUES
    (1, 'Figma'),
    (2, 'User Research'),
    (3, 'Prototype'),
    (4, 'React'),
    (5, 'NextJS'),
    (6, 'TypeScript'),
    (7, 'Python'),
    (8, 'SQL'),
    (9, 'Tableau'),
    (10, 'UI Design'),
    (11, 'Wireframing'),
    (12, 'Illustrator'),
    (13, 'SEO'),
    (14, 'Copywriting'),
    (15, 'Google Ads'),
    (16, 'Excel'),
    (17, 'BI Tools'),
    (18, 'Finance')
ON DUPLICATE KEY UPDATE
    name = VALUES(name);

INSERT INTO jobs (
    id, company_id, title, department, description, qualifications,
    location, work_mode, employment_type, salary_min, salary_max,
    salary_period, quota, status, logo_text, logo_background_color,
    logo_text_color, published_at
) VALUES
    (1, 1, 'UI/UX Intern', 'design',
     'Kesempatan magang untuk membantu proses riset pengguna, perancangan antarmuka, dan pembuatan prototipe.',
     'Memiliki minat pada UI/UX, mampu menggunakan Figma, dan bersedia belajar dalam tim.',
     'Remote', 'remote', 'internship', 2000000, 2000000, 'monthly', 3, 'published', 'GJ', '#EFF6FF', '#2563EB', CURRENT_TIMESTAMP),
    (2, 2, 'Frontend Developer', 'tech',
     'Kesempatan untuk mengembangkan dan memelihara antarmuka aplikasi web.',
     'Memahami dasar pengembangan web dan memiliki minat pada React, NextJS, atau TypeScript.',
     'Jakarta', 'onsite', 'full_time', 8000000, 8000000, 'monthly', 2, 'published', 'TK', '#F0FDF4', '#16A34A', CURRENT_TIMESTAMP),
    (3, 3, 'Analis Data Magang', 'tech',
     'Kesempatan magang untuk membantu pengolahan data dan penyusunan laporan analisis.',
     'Memahami dasar Python dan SQL serta tertarik pada visualisasi data.',
     'Hybrid', 'hybrid', 'internship', 1500000, 1500000, 'monthly', 2, 'published', 'BN', '#FFF7ED', '#EA580C', CURRENT_TIMESTAMP),
    (4, 4, 'UI Designer', 'design',
     'Kesempatan untuk mendukung perancangan antarmuka dan aset visual produk digital.',
     'Memahami prinsip UI design, wireframing, dan perangkat desain visual.',
     'Jakarta', 'onsite', 'full_time', 4000000, 4000000, 'monthly', 2, 'published', 'SP', '#EFF6FF', '#3B82F6', CURRENT_TIMESTAMP),
    (5, 5, 'Digital Marketing Intern', 'marketing',
     'Kesempatan magang untuk mendukung kegiatan pemasaran digital dan pembuatan konten.',
     'Memiliki minat pada SEO, copywriting, dan pemasaran digital.',
     'Remote', 'remote', 'internship', 2000000, 2000000, 'monthly', 3, 'published', 'TL', '#F5F3FF', '#8B5CF6', CURRENT_TIMESTAMP),
    (6, 6, 'Business Analyst', 'business',
     'Kesempatan untuk membantu analisis kebutuhan bisnis dan penyusunan laporan.',
     'Mampu menggunakan spreadsheet dan tertarik pada analisis bisnis atau keuangan.',
     'Jakarta', 'onsite', 'full_time', 6000000, 6000000, 'monthly', 2, 'published', 'BM', '#FEF2F2', '#EF4444', CURRENT_TIMESTAMP)
ON DUPLICATE KEY UPDATE
    company_id = VALUES(company_id),
    title = VALUES(title),
    department = VALUES(department),
    description = VALUES(description),
    qualifications = VALUES(qualifications),
    location = VALUES(location),
    work_mode = VALUES(work_mode),
    employment_type = VALUES(employment_type),
    salary_min = VALUES(salary_min),
    salary_max = VALUES(salary_max),
    salary_period = VALUES(salary_period),
    quota = VALUES(quota),
    status = VALUES(status),
    logo_text = VALUES(logo_text),
    logo_background_color = VALUES(logo_background_color),
    logo_text_color = VALUES(logo_text_color);

INSERT INTO job_skills (job_id, skill_id) VALUES
    (1, 1), (1, 2), (1, 3),
    (2, 4), (2, 5), (2, 6),
    (3, 7), (3, 8), (3, 9),
    (4, 10), (4, 11), (4, 12),
    (5, 13), (5, 14), (5, 15),
    (6, 16), (6, 17), (6, 18)
ON DUPLICATE KEY UPDATE
    skill_id = VALUES(skill_id);
