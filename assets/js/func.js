   var selected = null;
function selectChange(x)
{
if(selected != null) selected.className = '';
selected = x;
x.className = 'active';
}