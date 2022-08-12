using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsumirApi.Models
{
    class ResultData<T>
    {
        public string message { get; set; }
        public int status { get; set; }
        public List<T> data { get; set; }
    }
}
