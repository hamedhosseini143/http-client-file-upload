_______install__________
1- drush en http_client_file_upload
2- drush cr
3- enable file upload base64 in this route /admin/config/services/rest

_______use__________

path: sitemap/api/rest-file-upload
method: POST
body:
{
  "file": "base64 file",
  "filename": "file name"
}
headers:
{
  "Authorization": "Bearer token"
}
