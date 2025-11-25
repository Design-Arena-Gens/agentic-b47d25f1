INSERT INTO roles (name, slug, permissions) VALUES
('Super Administrator', 'SUPER_ADMIN', JSON_ARRAY()),
('Administrator', 'ADMIN', JSON_ARRAY()),
('Content Manager', 'CONTENT_MANAGER', JSON_ARRAY())
ON DUPLICATE KEY UPDATE name = VALUES(name), permissions = VALUES(permissions);

INSERT INTO brands (slug, name, tagline, primary_color, secondary_color, meta_description)
VALUES
('shnikh', 'Shnikh Agrobiotech Pvt. Ltd.', 'Advanced Plant Tissue Culture & Agri-Biotech', '#14532d', '#22c55e', 'Plant tissue culture and agri-biotech solutions'),
('cordygen', 'Cordygen', 'Cordyceps Wellness Products', '#7c2d12', '#f97316', 'Cordyceps-based nutraceuticals and wellness products')
ON DUPLICATE KEY UPDATE name = VALUES(name), tagline = VALUES(tagline), primary_color = VALUES(primary_color), secondary_color = VALUES(secondary_color), meta_description = VALUES(meta_description);

INSERT INTO users (name, email, password, role_id)
VALUES ('Platform Super Admin', 'admin@shnikhplatform.com', '$2y$10$ap7JrGQMw9hXvpN.1nU9UeXbKGUSZnYYAhuxaAEZXQ6oBOkDw9Laa', (SELECT id FROM roles WHERE slug = 'SUPER_ADMIN'))
ON DUPLICATE KEY UPDATE name = VALUES(name), password = VALUES(password), role_id = VALUES(role_id);
