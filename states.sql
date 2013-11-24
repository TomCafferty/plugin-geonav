# SQLiteManager Dump
# Version: 1.2.4
# http://www.sqlitemanager.org/
#
# Host: test.glocalfocal.com
# Generation Time: Thursday 21st 2013f November 2013 03:17 pm
# SQLite Version: 2.8.17
# PHP Version: 5.3.27
# Database: test.sqlite
# --------------------------------------------------------

#
# Table structure for table: states
#
CREATE TABLE states ( state_id int UNIQUE PRIMARY KEY, state char(32) NOT NULL, state_abbr char(8) DEFAULT NULL, is_state int NOT NULL);

#
# Dumping data for table: states
#
INSERT INTO 'states' VALUES ('1', 'Alabama', 'AL', '1');
INSERT INTO 'states' VALUES ('2', 'Alaska', 'AK', '1');
INSERT INTO 'states' VALUES ('3', 'Arizona', 'AZ', '1');
INSERT INTO 'states' VALUES ('4', 'Arkansas', 'AR', '1');
INSERT INTO 'states' VALUES ('5', 'California', 'CA', '1');
INSERT INTO 'states' VALUES ('6', 'Colorado', 'CO', '1');
INSERT INTO 'states' VALUES ('7', 'Connecticut', 'CT', '1');
INSERT INTO 'states' VALUES ('8', 'Delaware', 'DE', '1');
INSERT INTO 'states' VALUES ('9', 'District of Columbia', 'DC', '1');
INSERT INTO 'states' VALUES ('10', 'Florida', 'FL', '1');
INSERT INTO 'states' VALUES ('11', 'Georgia', 'GA', '1');
INSERT INTO 'states' VALUES ('12', 'Hawaii', 'HI', '1');
INSERT INTO 'states' VALUES ('13', 'Idaho', 'ID', '1');
INSERT INTO 'states' VALUES ('14', 'Illinois', 'IL', '1');
INSERT INTO 'states' VALUES ('15', 'Indiana', 'IN', '1');
INSERT INTO 'states' VALUES ('16', 'Iowa', 'IA', '1');
INSERT INTO 'states' VALUES ('17', 'Kansas', 'KS', '1');
INSERT INTO 'states' VALUES ('18', 'Kentucky', 'KY', '1');
INSERT INTO 'states' VALUES ('19', 'Louisiana', 'LA', '1');
INSERT INTO 'states' VALUES ('20', 'Maine', 'ME', '1');
INSERT INTO 'states' VALUES ('21', 'Maryland', 'MD', '1');
INSERT INTO 'states' VALUES ('22', 'Massachusetts', 'MA', '1');
INSERT INTO 'states' VALUES ('23', 'Michigan', 'MI', '1');
INSERT INTO 'states' VALUES ('24', 'Minnesota', 'MN', '1');
INSERT INTO 'states' VALUES ('25', 'Mississippi', 'MS', '1');
INSERT INTO 'states' VALUES ('26', 'Missouri', 'MO', '1');
INSERT INTO 'states' VALUES ('27', 'Montana', 'MT', '1');
INSERT INTO 'states' VALUES ('28', 'Nebraska', 'NE', '1');
INSERT INTO 'states' VALUES ('29', 'Nevada', 'NV', '1');
INSERT INTO 'states' VALUES ('30', 'New Hampshire', 'NH', '1');
INSERT INTO 'states' VALUES ('31', 'New Jersey', 'NJ', '1');
INSERT INTO 'states' VALUES ('32', 'New Mexico', 'NM', '1');
INSERT INTO 'states' VALUES ('33', 'New York', 'NY', '1');
INSERT INTO 'states' VALUES ('34', 'North Carolina', 'NC', '1');
INSERT INTO 'states' VALUES ('35', 'North Dakota', 'ND', '1');
INSERT INTO 'states' VALUES ('36', 'Ohio', 'OH', '1');
INSERT INTO 'states' VALUES ('37', 'Oklahoma', 'OK', '1');
INSERT INTO 'states' VALUES ('38', 'Oregon', 'OR', '1');
INSERT INTO 'states' VALUES ('39', 'Pennsylvania', 'PA', '1');
INSERT INTO 'states' VALUES ('40', 'Rhode Island', 'RI', '1');
INSERT INTO 'states' VALUES ('41', 'South Carolina', 'SC', '1');
INSERT INTO 'states' VALUES ('42', 'South Dakota', 'SD', '1');
INSERT INTO 'states' VALUES ('43', 'Tennessee', 'TN', '1');
INSERT INTO 'states' VALUES ('44', 'Texas', 'TX', '1');
INSERT INTO 'states' VALUES ('45', 'Utah', 'UT', '1');
INSERT INTO 'states' VALUES ('46', 'Vermont', 'VT', '1');
INSERT INTO 'states' VALUES ('47', 'Virginia', 'VA', '1');
INSERT INTO 'states' VALUES ('48', 'Washington', 'WA', '1');
INSERT INTO 'states' VALUES ('49', 'West Virginia', 'WV', '1');
INSERT INTO 'states' VALUES ('50', 'Wisconsin', 'WI', '1');
INSERT INTO 'states' VALUES ('51', 'Wyoming', 'WY', '1');
INSERT INTO 'states' VALUES ('52', 'Puerto Rico', NULL, '0');
INSERT INTO 'states' VALUES ('53', 'Virgin Islands', NULL, '0');
INSERT INTO 'states' VALUES ('54', 'Guam', NULL, '0');
INSERT INTO 'states' VALUES ('55', 'American Samoa', NULL, '0');
INSERT INTO 'states' VALUES ('56', 'Northern Marianas', NULL, '0');
INSERT INTO 'states' VALUES ('57', 'United States', 'US', '0');