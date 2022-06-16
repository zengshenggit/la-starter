local search_dir = "/workspace/www"
function get_current_workspace()
  --local full_path = vim.api.nvim_buf_get_name(0)
  local full_path = '/workspace/www/la/app/Http/Controllers/AuthController.php'
  local sub_path = string.match(full_path, search_dir .. "/(%a+)/")
  if not sub_path then
    return full_path
  end
  return search_dir .. '/' .. sub_path
end

print(get_current_workspace())
