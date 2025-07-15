-- Update pages table structure for simplified content management
USE istethmar;

-- Add new content fields
ALTER TABLE pages 
ADD COLUMN content_ar LONGTEXT NULL AFTER description,
ADD COLUMN content_en LONGTEXT NULL AFTER content_ar;

-- Drop old complex fields that are not user-friendly
ALTER TABLE pages 
DROP COLUMN IF EXISTS html_content,
DROP COLUMN IF EXISTS html_content_en,
DROP COLUMN IF EXISTS html_content_ar,
DROP COLUMN IF EXISTS css_styling,
DROP COLUMN IF EXISTS js_functionality;

-- Show updated table structure
DESCRIBE pages;
